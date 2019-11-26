<?php
session_start();
if (empty($_SESSION['per_num'])) {
  $_SESSION['per_num'] = null;
  $_SESSION['connexion'] = false;
  $_SESSION['per_login'] = "none";
  $_SESSION['estSalarie'] = null;
  $_SESSION['estAdmin'] = null;
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
      <?php
      if (empty($_SESSION['per_num'])) {
        echo '<a href="index.php?page=14">Connexion</a>';
      }
      else{
        echo '<p>Utilisateur : '.$_SESSION['per_login'].' <a href="index.php?page=18">Deconnexion</a></p>';
      }
      ?>
		</div>

		<div id="entete">
			<div id="logo">
        <?php if ($_SESSION['connexion']) { ?>
          <img id="imageSourire" src="image/smile.jpg" alt="grosSourire">
        <?php }
        ?>
			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
