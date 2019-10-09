<?php
$db = new Mypdo();
$manager = new VilleManager($db);
?>

	<h1>Liste des villes</h1>
	<?php echo "Actuellement ".$manager->nbVille()." villes sont enregistrés"; ?>
	<table>
   <tr>
     <th>Numero</th>
     <th>Nom</th>
  </tr>
  <?php

$listeVille = $manager->getListVille	();
foreach ($listeVille as $ville) {
    ?>
    <tr>
      <td> <?php echo $ville->getVilNum(); ?> </td>
      <td> <?php echo $ville->getVilNom(); ?> </td>
    </tr>
  <?php }
?>
  </table>
