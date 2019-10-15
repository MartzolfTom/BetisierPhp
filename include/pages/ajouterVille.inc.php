<?php
$db = new Mypdo();
$manager = new VilleManager($db);
?>

<h1>Ajouter une ville</h1>

<?php
if (empty($_POST['vil_nom'])) {
    ?>
  <form method ="post" action ="#">

    Nom : <input type="text" name="vil_nom" value="Sarlat"/>
        <input type="submit" name="Valider" />
  </form>
<?php } else {

    $tab = array('vil_nom' => $_POST['vil_nom']);
    $ville = new Ville($tab);

    $manager->add($ville);
    echo "La ville \"".$_POST['vil_nom']."\" a été ajouté";
}
?>
