<?php
$_SESSION['perNumConnexion'] = null;
$_SESSION['connexion'] = false;
$_SESSION['per_login'] = "none";
$_SESSION['estSalarie'] = null;
$_SESSION['estAdmin'] = null;

header("Refresh: 2; url=index.php?page=0");
?>

<p>Vous avez été déconnecté</p>
<p>Redirection dans 2 secondes</p>
