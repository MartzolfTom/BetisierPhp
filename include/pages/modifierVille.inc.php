<?php
$db = new Mypdo();
$manager = new VilleManager($db);
$listeVille = $manager->getListVille();

if (!empty($_POST['vil_num'])) {
  $_SESSION['vil_num']=$_POST['vil_num'];
}
?>

	<h1>Modifier une ville</h1>

<?php
if (empty($_POST['vil_num']) && empty($_POST['nom_ville_modif'])) {
    ?>
  <form method ="post" action ="#">
  Nom : <select size="1" name="vil_num">

  <?php
foreach ($listeVille as $ville) {
        ?>
    <option value=<?php echo $ville->getVilNum(); ?>> <?php echo $ville->getVilNom(); ?> </option> <?php
}?>

 </select>
 <input type="submit" name="Valider" />
</form>
<?php } else if (empty($_POST['nom_ville_modif'])) {
  ?>

  <form method ="post" action ="#">
    Nom : <input type="text" name="nom_ville_modif" value="<?php echo $manager->nomVille($_POST['vil_num']) ?>"> <br/> <br/>
    <input type="submit" name="" value="Valider">
  </form>

<?php
} else {
  $tab = array('vil_num' => $_SESSION['vil_num'], 'vil_nom' => $_POST['nom_ville_modif']);

  $ville = new Ville($tab);

  $manager->modifVille($ville);

  echo "modification effectué";
} ?>
