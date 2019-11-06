<?php
$db = new Mypdo();
$managerCitation = new CitationManager($db);
$managerPersonne = new PersonneManager($db);
$listeCitation = $managerCitation->getListCitation();
$listeSalarie = $managerPersonne->getListSalarie();
?>


<?php
if (empty($_POST['cit_date_debut'])) {
    ?>
    <h1>rechercher une citation</h1>

  <form method ="post" action ="#">

    Salarie : <select size="1" name="per_num"/>
    <option value="0" > Choissiez salarie </option><?php
    foreach ($listeSalarie as $personne) {  ?>
        <option value= <?php echo $personne->getPerNum(); ?>>  <?php echo $personne->getPerNom(); ?> </option> <?php }?>
  </select>

     Date citation entre:  <input type="date" name="cit_date_debut" value="<?php echo $managerCitation->getDatePlusAncienne();?>">
     et : <input type="date" name="cit_date_fin" value="<?php echo $managerCitation->getDateJour();?>">

     Note citation entre : <input type="text" name="cit_note_debut" value="0" size="1">
     et <input type="text" name="cit_note_fin" value="20" size="1"><br /><br />


        <input type="submit" name="Valider" />
  </form>
<?php } else {

    $per_num=$_POST['per_num'];
    $cit_date_debut=$_POST['cit_date_debut'];
    $cit_date_fin=$_POST['cit_date_fin'];
    $cit_note_debut=$_POST['cit_note_debut'];
    $cit_note_fin=$_POST['cit_note_fin'];

?>
    <h1>Resultat de la recherche des citations  </h1>
    <?php
    if(!empty($listeRechercheCitation)){ ?>

  	<table>
     <tr>
       <th>Nom de l'enseignant</th>
       <th>Libellé</th>
  		 <th>Date</th>
  		 <th>Moyenne des notes</th>

    </tr>
    <?php
  $listeRechercheCitation = $managerCitation->getListRechercheCitation($per_num,$cit_date_debut,$cit_date_fin,$cit_note_debut,$cit_note_fin);
  foreach ($listeRechercheCitation as $citation) {
      ?>
      <tr>
        <td> <?php echo $citation->getCitPersonneCit(); ?> </td>
        <td> <?php echo $citation->getCitLibelle(); ?> </td>
  			<td> <?php echo $citation->getCitDate(); ?> </td>
  			<td> <?php echo $citation->getCitMoyNotes(); ?> </td>
      </tr>
    <?php }
  ?>
    </table>
  <?php }else {
    echo " Aucuns resultats coresspondants aux critères de recherche";
  }
} ?>
