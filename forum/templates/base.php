<!DOCTYPE html>
<html>
	<head>
		<title><?= $titre ?></title>
		<link rel="stylesheet" type="text/css" href="">
	</head>

	<body>
		<?php if(!isset($_SESSION['pseudo'])){ ?>
			<p>
				<form action="" method="post">
					<input type="text" name="pseudo" placeholder="Pseudonyme">
					<input type="text" name="pass" placeholder="Mot de passe">
					<input type="submit" name="connexion">
				</form>
				<a href="?action=inscription">Inscription</a>
			</p>
		<?php } else { ?>
			<a href="?action=deconnexion">Déconnexion</a>
		<?php } ?>

		<?= $contenu ?>
	</body>
</html>