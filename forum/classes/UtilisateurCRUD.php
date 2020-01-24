<?php
class UtilisateurCRUD {
	private $_db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function detailsUtilisateur(int $id){
		$req = $this->_db->prepare('
			SELECT * 
			FROM utilisateurs 
			WHERE id = :id 
		');
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$donnees = new Utilisateur($req->fetch(PDO::FETCH_ASSOC));

		return $donnees;
	}

	public function ajouter(Utilisateur $utilisateur){
		$req = $this->_db->prepare('
			INSERT INTO utilisateurs(pseudo, email, pass, date_creation) 
			VALUES(:pseudo, :email, :pass, :date_creation)
		');
		$req->bindValue(':pseudo', $utilisateur->pseudo(), PDO::PARAM_STR);
		$req->bindValue(':email', $utilisateur->email(), PDO::PARAM_STR);
		$req->bindValue(':pass', $utilisateur->pass(), PDO::PARAM_STR);
		$req->bindValue(':date_creation', date("Y-m-d H:i:s"));
		$req->execute();
	}

	public function verifUtilisateur(Utilisateur $utilisateur){
		$req = $this->_db->prepare('
			SELECT count(*) 
			FROM utilisateurs 
			WHERE pseudo = :pseudo 
			AND pass = :pass
		');
		$req->bindValue(':pseudo', $utilisateur->pseudo(), PDO::PARAM_STR);
		$req->bindValue(':pass', $utilisateur->pass(), PDO::PARAM_STR);
		$req->execute();

		if($utilisateur->pseudo()){
			if($utilisateur->pass()){
				if($req->fetchColumn() == 1){
					return true;
				} else {
					echo 'Le pseudonyme ou le mot de passe sont incorrects.';
				}
			} else {
				echo 'Le champ "Mot de passe" est obligatoire.';
			}
		} else {
			echo 'Le champ "Pseudonyme" est obligatoire.';
		}
	}

	public function profil(Utilisateur $utilisateur){
		$req = $this->_db->prepare('
			SELECT * 
			FROM utilisateurs 
			WHERE pseudo = :pseudo 
			AND pass = :pass
		');
		$req->bindValue(':pseudo', $utilisateur->pseudo(), PDO::PARAM_STR);
		$req->bindValue(':pass', $utilisateur->pass(), PDO::PARAM_STR);
		$req->execute();

		$utilisateur = new Utilisateur($req->fetch(PDO::FETCH_ASSOC));

		$_SESSION['pseudo'] = $utilisateur->pseudo();
		$_SESSION['id'] = $utilisateur->id();
	}

	public function setDb($db){
		$this->_db = $db;
	}
}