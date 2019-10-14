<?php
$db = new Mypdo();
$manager = new VilleManager($db);
?>

<h1>Ajouter une ville</h1>

<?php
if (empty($_POST['vil_nom'])) {
    ?>
  <table class="nobordered">
  <form method ="post" action ="#">
  <tr>
    <td> Nom</td>
    <td><input type="text" name="vil_nom" value="Sarlat"/></td>
  </tr>
  <tr>
    <td><input type="submit" name="Valider" /></td>
  </tr>
  </table>

<?php } else {

    $tab = array('vil_nom' => $_POST['vil_nom']);
    $ville = new Ville($tab);

    $manager->add($ville);
    echo "La ville \"".$_POST['vil_nom']."\" a été ajouté";
}
?>
