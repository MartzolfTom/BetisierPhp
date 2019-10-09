<?php
$db = new Mypdo();
$manager = new VilleManager($db);
$listeVille = $manager->getListVille();
?>

	<h1>Supprimer une ville</h1>

<?php
if (empty($_POST['vil_num'])) {
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
<?php } else {

    $tab = array('vil_num' => $_POST['vil_num']);

    $ville = new Ville($tab);

    $manager->supprVille($ville);

    echo "suppression effectué";
}
?>
