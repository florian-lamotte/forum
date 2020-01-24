<?php
	$titre = 'Nouveau sujet';

	ob_start();
?>

<p><a href="/forum">Tous les sujets</a></p>

<?php if(isset($_SESSION['pseudo'])){ ?>
<div>
	<form action="" method="post">
		<p><input type="text" name="titre" placeholder="Titre"></p>
		<p><input type="submit" name="valider"></p>
	</form>
</div>
<?php } ?>

<?php 
	$contenu = ob_get_clean();
	
	require('base.php');
?>