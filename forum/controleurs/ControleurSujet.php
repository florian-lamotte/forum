<?php
class ControleurSujet {
	public static function listeSujets($db){
		$obj_sujet = new SujetCRUD($db);
		$obj_utilisateur = new UtilisateurCRUD($db);

		$listeSujets = $obj_sujet->listeSujets();

		include('templates/sujets.php');
	}

	public static function sujet($db){
		$obj_message = new MessageCRUD($db);
		$obj_sujet = new SujetCRUD($db);
		$obj_utilisateur = new UtilisateurCRUD($db);

		if(isset($_POST['valider']) && isset($_POST['message']) && !empty($_POST['message'])){
			$message = new Message([
				'message' => $_POST['message'],
				'id_utilisateur' => $_SESSION['id'],
				'id_sujet' => $_GET['sujet']
			]);

			$obj_message->ajouter($message);
		}

		$detailsSujet = $obj_sujet->detailsSujet($_GET['sujet']);
		$listeMessages = $obj_message->listeMessages($_GET['sujet']);

		include('templates/messages.php');
	}

	public static function creer_sujet($db){
		$obj_sujet = new SujetCRUD($db);

		if(isset($_POST['valider']) && isset($_POST['titre']) && !empty($_POST['titre'])){
			$sujet = new Sujet([
				'titre' => $_POST['titre'],
				'id_utilisateur' => $_SESSION['id']
			]);

			$obj_sujet->creerSujet($sujet);
			header('Location: /forum/?action=sujet&sujet=' . $obj_sujet->dernierSujet($_SESSION['id']));
		}

		include('templates/creer-sujet.php');
	}
}