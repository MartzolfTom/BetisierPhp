<?php
$db = new Mypdo();
$connexionManager = new ConnexionManager($db);
$salarieManager = new SalarieManager($db);

$nb_alea1 = rand(1, 9);
$nb_alea2 = rand(1, 9);

?>

<h1>Pour vous connecter</h1>

<?php
  if (empty($_POST['per_login'])) {
  $_SESSION['bonResultat'] = $nb_alea1 + $nb_alea2;
?>

<form action="#" method="post">
  Nom d'utilisateur : <input type="text" name="per_login" value="MichouDu87"> <br/><br/>
  Mot de passe :      <input type="password" name="pwd" value="Rahnon"> <br/><br/>
  <img src="image/nb/<?php echo $nb_alea1 ?>.jpg" alt="premierNombre"> +
  <img src="image/nb/<?php echo $nb_alea2 ?>.jpg" alt="secondNombre"> =
  <input type="text" name="resultat" value=""> <br/><br/>
  <input type="submit" name="" value="Connexion"> <br/><br/>
</form>
<?php
}
else if(!empty($_POST['per_login'])){
  if ($_SESSION['bonResultat'] == $_POST['resultat'] && $connexionManager->connexion($_POST['pwd'], $_POST['per_login']) ) {
    echo 'Connexion réussie !';

    $_SESSION['per_login'] = $_POST['per_login'];
    $_SESSION['connexion'] = true;
    $_SESSION['per_num'] = $connexionManager->connexion($_POST['pwd'], $_POST['per_login'])->per_num;
    $_SESSION['estAdmin'] = $connexionManager->connexion($_POST['pwd'], $_POST['per_login'])->per_admin;

    $detailSalarie = $salarieManager->getDetailSalarie($_SESSION['per_num']);

    if ($detailSalarie) {
      $_SESSION['estSalarie'] = true;
    }
    else {
      $_SESSION['estSalarie'] = false;
    }

    echo '<p>Redirection dans 2 secondes</p>';
    header("Refresh: 2; url=index.php?page=0");

  } else {
    echo "Connexion échouée. Mot de passe, login invalide ou mauvais Capcha";
  }

}
?>
