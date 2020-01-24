<?php
class SujetCRUD {
	private $_db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function listeSujets(){
		$sujets = [];

		$req = $this->_db->query('
			SELECT *
			FROM utilisateurs u, sujets 
			WHERE u.id = id_utilisateur
		');

		while($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$sujets[] = new Sujet($donnees);
		}

		return $sujets;
	}

	public function detailsSujet(int $id){
		$req = $this->_db->prepare('
			SELECT * 
			FROM sujets s, utilisateurs u 
			WHERE id_utilisateur = u.id 
			AND s.id = :id'
		);
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$donnees = new Sujet($req->fetch(PDO::FETCH_ASSOC));

		return $donnees;
	}

	public function creerSujet(Sujet $sujet){
		$req = $this->_db->prepare('
			INSERT INTO sujets(titre, date_creation, id_utilisateur) 
			VALUES(:titre, :date_creation, :id_utilisateur)
		');
		$req->bindValue(':titre', $sujet->titre(), PDO::PARAM_STR);
		$req->bindValue(':date_creation', date("Y-m-d H:i:s"));
		$req->bindValue(':id_utilisateur', $sujet->id_utilisateur(), PDO::PARAM_INT);
		$req->execute();
	}

	public function nombreReponses(int $id){
		$req = $this->_db->prepare('
			SELECT count(*) 
			FROM sujets s, messages 
			WHERE s.id = id_sujet 
			AND id_sujet = :id'
		);
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();

		return $req->fetchColumn();
	}

	public function dernierSujet(int $id){
		$req = $this->_db->prepare('
			SELECT *  
			FROM sujets  
			WHERE id_utilisateur = :id 
			ORDER BY id DESC'
		);
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();

		return $req->fetchColumn();
	}

	public function setDb($db){
		$this->_db = $db;
	}
}