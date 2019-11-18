<?php
$db = new Mypdo();
$manager = new CitationManager($db);

if (empty($_GET['cit_num'])) {

?>


	<h1>Liste des citations déposées </h1>
	<table>
   <tr>
     <th>Nom de l'enseignant</th>
     <th>Libellé</th>
		 <th>Date</th>
		 <th>Valider</th>
  </tr>
  <?php

$listeCitation = $manager->getListCitationNonValides();
foreach ($listeCitation as $citation) {
    ?>
    <tr>
      <td> <?php echo $citation->getCitPersonneCit(); ?> </td>
      <td> <?php echo $citation->getCitLibelle(); ?> </td>
			<td> <?php echo $citation->getCitDate(); ?> </td>
			<td><a href="index.php?page=8&cit_num=<?php echo $citation->getCitNum(); ?>" >
					<img src="image/valid.png" alt="valider"> </a></td>
    </tr>
  <?php }
?>
  </table>
<?php } else {

  $cit_num=$_GET['cit_num'];
  //$per_num_valide=
echo $_SESSION['per_num'];
  $manager->validerCitation($cit_num,$_SESSION['per_num']);

  echo "validation effectué";
} ?>
