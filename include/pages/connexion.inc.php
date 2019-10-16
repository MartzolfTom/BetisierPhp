<?php
$db = new Mypdo();
$manager = new ConnexionManager($db);

$nb_alea1 = rand(1, 20);
$nb_alea2 = rand(1, 20);

?>

<h1> Pour vous connecter</h1>

<?php
if (empty($_POST['nom'])) {
    ?>

<form action="#" method="post">
  Nom d'utilisateur : <input type="text" name="per_login" value="Bob"> <br/><br/>
      Mot de passe :      <input type="password" name="mdp" value="BornToRun"> <br/><br/>
      <input type="text" name="nb_alea1" value="<?php echo $nb_alea1; ?> " size="1"> +
      <input type="text" name="nb_alea2" value="<?php echo $nb_alea2; ?> " size="1"> =
      <input type="text" name="somme_nombre" value=""> <br/><br/>
      <input type="submit" name="" value="Envoyer"> <br/><br/>
</form>
<?php
}
else {
    //declaration des variables de session, du mot de passe et du resultat
    $_SESSION['per_login'] = $_POST['per_login'];
    $mdp = $_POST['mdp'];

    $nb1 = $_POST['nb_alea1'];
    $nb2 =  $_POST['nb_alea2'];
    $resultat =  $nb1.$nb2;
    $saisieResultat = $_POST['somme_nombre'];

    //on verifie en premier lieu que le nombre rentree est le bonne
    if ($resultat = $saisieResultat) {

      //en cas de bonne connexion
      if ($manager->Login($mdp) == true) {
        echo "Vous avez bien été connecté !";
        echo "<br /><br />";
        echo "Redirection automatique dans 2 secondes";
      }
      //en cas de mauvaise connexion
      else {
        echo "Echec de la connection, mot de passe ou nom incorrect";
      }

    }
    else {
      echo "Vous vous etes trompe dans votre calcul";
    }
}
?>
