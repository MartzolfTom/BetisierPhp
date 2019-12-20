<?php
$db = new Mypdo();
$manager = new CitationManager($db);
?>

	<h1>Liste des citations déposées </h1>
	<?php echo "Actuellement ".$manager->nbcitations()." citation(s) sont enregistrée(s)"; ?>
	<table>
   <tr>
     <th>Nom de l'enseignant</th>
     <th>Libellé</th>
		 <th>Date</th>
		 <th>Moyenne des notes</th>
		 <th>Noter</th>
  </tr>
  <?php

$listeCitationPasNotees = $manager->getListCitationPasNotées($_SESSION['perNumConnexion']);
$listeCitationDejaNotees = $manager->getListCitationDejaNotées($_SESSION['perNumConnexion']);

foreach ($listeCitationPasNotees as $citation) {
    ?>
    <tr>
      <td> <?php echo $citation->getCitPersonneCit(); ?> </td>
      <td> <?php echo $citation->getCitLibelle(); ?> </td>
			<td> <?php echo $citation->getCitDate(); ?> </td>
			<td> <?php echo $citation->getCitMoyNotes(); ?> </td>
			<td>
				<?php if ($_SESSION['estEtudiant']){ ?>
				<a href="index.php?page=17&cit_num=<?php echo $citation->getCitNum(); ?>" >
				<img src="image/modifier.png" alt="petitCrayon"> </a>
			</td>
		</tr>
				<?php }else{ ?>
				<img src="image/erreur.png" alt="erreur">
			</td>
    </tr>

  <?php  }
				}foreach ($listeCitationDejaNotees as $citation) {
	    ?>
	    <tr>
	      <td> <?php echo $citation->getCitPersonneCit(); ?> </td>
	      <td> <?php echo $citation->getCitLibelle(); ?> </td>
				<td> <?php echo $citation->getCitDate(); ?> </td>
				<td> <?php echo $citation->getCitMoyNotes(); ?> </td>
				<td>
						<img src="image/erreur.png" alt="erreur"> </a>
			  </td>
	    </tr>

	  <?php }
	?>

  </table>
