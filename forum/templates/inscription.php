<?php
	$titre = 'Inscription';

	ob_start();
?>

<p><a href="/forum">Tous les sujets</a></p>

<div>
	<form action="" method="post">
		<p><input type="text" name="pseudo" placeholder="Pseudo"></p>
		<p><input type="password" name="pass" placeholder="Pass"></p>
		<p><input type="email" name="email" placeholder="Email"></p>
		<p><input type="submit" name="valider"></p>
	</form>
</div>

<?php 
	$contenu = ob_get_clean();

	require('base.php');
?>