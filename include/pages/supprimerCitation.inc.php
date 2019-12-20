<?php
$db = new Mypdo();
$manager = new CitationManager($db);
$listeCitation = $manager->getAllListCitation();
?>

	<h1>Supprimer une citation</h1>

<?php
if (empty($_POST['cit_num'])) {
    ?>
  <form method ="post" action ="#">
  libelle : <select size="1" name="cit_num">

  <?php
foreach ($listeCitation as $citation) {
        ?>
    <option value= <?php echo $citation->getCitNum(); ?>> <?php echo $citation->getCitLibelle(); ?> </option> <?php
}?>

 </select>
 <input type="submit" name="Valider" />
 </form>
 <?php } else {

    $tab = array('cit_num' => $_POST['cit_num']);
    $citation = new Citation($tab);
    $manager->supprimerCitation($citation);

    echo "suppression effectué";
}
?>
