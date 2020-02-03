<?php 
require 'classes/Autoload.php';
require 'controleurs/ControleurSujet.php';
require 'controleurs/ControleurUtilisateur.php';

$connexion = new Connexion;
$db = $connexion->connexion();

session_start();

if(isset($_POST['connexion'])){
	$obj_utilisateur = new UtilisateurCRUD($db);

	$utilisateur = new Utilisateur([
		'pseudo' => htmlspecialchars($_POST['pseudo']),
		'pass' => htmlspecialchars($_POST['pass'])
	]);

	if($obj_utilisateur->verifUtilisateur($utilisateur)){
		$obj_utilisateur->profil($utilisateur);
		header('Location: /forum');
	}
} else if(isset($_GET['action'])){ 
	$action = $_GET['action'];

	if($action == 'sujet'){
		ControleurSujet::$action($db);
	} else if($action == 'creer_sujet'){
		ControleurSujet::$action($db);
	} else if($action == 'inscription'){
		ControleurUtilisateur::$action($db);
	} else if($action == 'deconnexion'){
		ControleurUtilisateur::$action();
	}
} else {
	ControleurSujet::listeSujets($db);
}