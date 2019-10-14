<?php
$db = new Mypdo();
$manager = new PersonneManager($db);
?>

	<h1>Liste des personnes enregistrées </h1>
	<?php echo "Actuellement ".$manager->nbpersonnes()." personne(s) sont enregistrée(s)"; ?>
	<table>
   <tr>
     <th>Numéro</th>
     <th>Nom</th>
		 <th>Prenom</th>
  </tr>
  <?php

$listePersonnes = $manager->getListPersonnes	();
foreach ($listePersonnes as $personne) {
    ?>
    <tr>
      <td  onclick='' >  <?php echo $personne->getPerNum(); ?> </td>
      <td> <?php echo $personne->getPerNom(); ?> </td>
			<td> <?php echo $personne->getPerPrenom(); ?> </td>
    </tr>
  <?php }
?>
  </table>
