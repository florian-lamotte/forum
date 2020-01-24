<?php
	$titre = 'Réponses';

	ob_start();
?>

<p><a href="/forum">Tous les sujets</a></p>

<div>
	<h3><b><?= $detailsSujet->titre() ?></b></h3>
	<?php foreach($listeMessages as $message){ ?>
		<div>
			<?= $obj_utilisateur->detailsUtilisateur($message->id_utilisateur())->pseudo() ?>
			<br>
			<?= $obj_utilisateur->detailsUtilisateur($message->id_utilisateur())->avatar() ?>
		</div>
		<div><?= $message->message() ?></div>
		<br>
	<?php } ?>
</div>

<?php if(isset($_SESSION['pseudo'])){ ?>
	<form action="" method="post">
		<p><textarea cols="40" rows="5" name="message" placeholder="Réponse"></textarea></p>
		<p><input type="submit" name="valider"></p>
	</form>
<?php } ?>

<?php 
	$contenu = ob_get_clean();
	
	require('base.php');
?>