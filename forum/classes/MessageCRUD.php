<?php
class MessageCRUD {
	private $_db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function listeMessages($id_sujet){
		$messages = [];

		$req = $this->_db->query('
			SELECT *
			FROM utilisateurs u, sujets s, messages m
			WHERE id_sujet = s.id 
			AND m.id_utilisateur = u.id 
			AND id_sujet = ' . $id_sujet
		);

		while($donnees = $req->fetch(PDO::FETCH_ASSOC)){
			$messages[] = new Message($donnees);
		}

		return $messages;
	}

	public function ajouter(Message $message){
		$req = $this->_db->prepare('
			INSERT INTO messages(message, date_creation, id_utilisateur, id_sujet) 
			VALUES(:message, :date_creation, :id_utilisateur, :id_sujet)
		');
		$req->bindValue(':message', $message->message(), PDO::PARAM_STR);
		$req->bindValue(':date_creation', date("Y-m-d H:i:s"));
		$req->bindValue(':id_utilisateur', $message->id_utilisateur(), PDO::PARAM_INT);
		$req->bindValue(':id_sujet', $message->id_sujet(), PDO::PARAM_INT);
		$req->execute();
	}

	public function setDb($db){
		$this->_db = $db;
	}
}