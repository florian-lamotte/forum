<?php
class ControleurUtilisateur {
	public static function inscription($db){
		$obj_utilisateur = new UtilisateurCRUD($db);

		include('templates/inscription.php');

		if(isset($_POST['valider']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['pass'])){
			$utilisateur = new Utilisateur([
				'pseudo' => $_POST['pseudo'],
				'email' => $_POST['email'],
				'pass' => $_POST['pass']
			]);

			$obj_utilisateur->ajouter($utilisateur);
		}
	}

	public static function deconnexion(){
		session_destroy();
		header('Location: /forum');
	}
}