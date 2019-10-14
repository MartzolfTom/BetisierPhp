<?php
$db = new Mypdo();
$manager = new ConnexionManager($db);

$nb_alea1=rand(1,20);
$nb_alea2=rand(1,20);

?>

<h1> Pour vous connecter</h1>

<?php
if (empty($_POST['nom'])) {
?>

<form action="#" method="post">
      Nom d'utilisateur : <input type="text" name="nom" value="tom"> <br/><br/>
      Mot de passe :      <input type="password" name="mdp" value="martzolf"> <br/><br/>
      <input type="text" name="nb_alea1" value="<?php echo $nb_alea1; ?> " size="1"> +
      <input type="text" name="nb_alea2" value="<?php echo $nb_alea2; ?> " size="1"> =
      <input type="text" name="somme_nombre" value=""> <br/><br/>
      <input type="submit" name="" value="Envoyer"> <br/><br/>
    </form>
<?php
} else {

if( $manager->Login() == true){
  echo "Vous avez bien été connecté !";
  echo "<br /><br />";
  echo "Redirection automatique dans 2 secondes";
}
else {
  echo "non déso";
}
}
 ?>
