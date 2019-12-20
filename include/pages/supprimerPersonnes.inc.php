<?php
	$db = new Mypdo();
	$personneManager = new PersonneManager($db);
	$nbPersonnes = $personneManager->nbpersonnes();
	echo 'Actuellement ' . $nbPersonnes . ' personnes enregistrées.'
?>

<h1>Supprimer des personnes enregistrées</h1>

<table>
 <tr>
	 <th>Nom</th>
	 <th>Prenom</th>
	 <th>Modifier</th>
</tr>

<?php
	$listePersonnes = $personneManager->getListPersonnes();
	foreach ($listePersonnes as $personne) { ?>
		<tr>
			<td> <?php echo $personne->getPerNom(); ?> </td>
			<td> <?php echo $personne->getPerPrenom(); ?> </td>
			<td><a href="index.php?page=19
					&per_num=<?php echo $personne->getPerNum(); ?>">
					<img src="image/erreur.png" alt="petiteCroix"> </a></td>
		</tr>
<?php } ?>
</table>
