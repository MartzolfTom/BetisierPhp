<?php
session_start();
if (empty($_SESSION['per_num'])) {
  $_SESSION['per_num'] = null;
  $_SESSION['connexion'] = false;
  $_SESSION['per_login'] = "none";
  $_SESSION['estSalarie'] = null;
  $_SESSION['estAdmin'] = false;
}

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
	<body>
	<div id="header">
		<div id="connect">
      <a href="index.php?page=14">Connexion</a>
		</div>

		<div id="entete">
			<div id="logo">

			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
