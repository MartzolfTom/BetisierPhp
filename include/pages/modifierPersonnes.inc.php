<?php
$db = new Mypdo();
$personneManager = new PersonneManager($db);
?>

<h1>Modifier une personne enregistrée</h1>

<?php
$nbPersonnes = $personneManager->nbpersonnes();
echo 'Actuellement ' . $nbPersonnes . ' personnes enregistrées.'
?>

<table>
 <tr>
	 <th>Nom</th>
	 <th>Prenom</th>
	 <th>Modifier</th>
</tr>
<?php

$listePersonnes = $personneManager->getListPersonnes();
foreach ($listePersonnes as $personne) {
    ?>
	<tr>
		<td> <?php echo $personne->getPerNom(); ?> </td>
		<td> <?php echo $personne->getPerPrenom(); ?> </td>
		<td><a href="index.php?page=16
				&per_num=<?php echo $personne->getPerNum(); ?>">
				<img src="image/modifier.png" alt="petitCrayon"> </a></td>
	</tr>
<?php }
?>
</table>
