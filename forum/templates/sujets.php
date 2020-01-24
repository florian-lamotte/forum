<?php
	$titre = 'Tous les sujets';

	ob_start();
?>

<?php if(isset($_SESSION['pseudo'])){ ?> <p><a href="?creer-sujet">Créer un sujet</a></p> <?php } ?>

<table>
	<tr>
		<th>Sujets</th>
		<th>Auteur</th>
		<th>Réponses</th>
	</tr>
	<?php foreach($listeSujets as $sujet){ ?>
	<tr>
		<td><a href="?sujet=<?= $sujet->id() ?>"><?= $sujet->titre() ?></a></td>
		<td><?= $obj_utilisateur->detailsUtilisateur($sujet->id_utilisateur())->pseudo() ?></td>
		<td><?php try { echo $obj_sujet->nombreReponses($sujet->id()); } 
		catch(TypeError $e){ echo 'Erreur'; } ?></td>
	</tr>
	<?php } ?>
</table>

<?php 
	$contenu = ob_get_clean();

	require('base.php');
?>