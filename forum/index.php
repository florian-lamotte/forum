<?php 
require 'classes/Autoload.php';

$connexion = new Connexion;
$db = $connexion->connexion();
$obj_message = new MessageCRUD($db);
$obj_sujet = new SujetCRUD($db);
$obj_utilisateur = new UtilisateurCRUD($db);

session_start();

if(isset($_POST['connexion'])){
	$utilisateur = new Utilisateur([
		'pseudo' => htmlspecialchars($_POST['pseudo']),
		'pass' => htmlspecialchars($_POST['pass'])
	]);

	if($obj_utilisateur->verifUtilisateur($utilisateur)){
		$obj_utilisateur->profil($utilisateur);
		header('Location: /forum');
	}
} else if(isset($_GET['action'])){ 
	if($_GET['action'] == 'deconnexion'){
		session_destroy();
		header('Location: /forum');
	} else if($_GET['action'] == 'sujet') {
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
	} else if($_GET['action'] == 'inscription') {
		include('templates/inscription.php');

		if(isset($_POST['valider']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['pass'])){
			$utilisateur = new Utilisateur([
				'pseudo' => $_POST['pseudo'],
				'email' => $_POST['email'],
				'pass' => $_POST['pass']
			]);

			$obj_utilisateur->ajouter($utilisateur);
		}
	} else if($_GET['action'] == 'creer-sujet') {
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
} else {
	$listeSujets = $obj_sujet->listeSujets();

	include('templates/sujets.php');
}