<?php

$db = new Mypdo();
$divisionManager = new DivisionManager($db);
$departementManager = new DepartementManager($db);

if (empty($_POST['per_nom'])) {
?>
	<h1>Ajouter une personne</h1>
	<form action="#" method="post">
		Nom : <input type="text" name="per_nom" value="Mare"> <br/> <br/>
		Prénom : <input type="text" name="per_prenom" value="Dorian"> <br/> <br/>
		Téléphone : <input type="text" name="per_tel" value="0629107479"> <br/> <br/>
		Mail : <input type="text" name="per_mail" value="dorianmare@yahoo.fr"> <br/> <br/>
		Login : <input type="text" name="per_login" value="MichouDu87"> <br/> <br/>
		Mot de passe : <input type="text" name="per_pwd" value="Rahnon"> <br/> <br/>
		Catégorie : <input type="radio" name="per_etu" value="etudiant">
		Etudiant <input type="radio" name="per_sal" value="salarie"> Salarie <br/> <br/>
		<input type="submit" name="" value="Valider">
	</form>

<?php } else if (!empty($_POST['per_etu'])) {
?>

	<h1>Ajouter un étudiant</h1>
	<form action="#" method="post">
		Année : <select name="div_num">
			<?php
			$divisions = array();
			$divisions = $divisionManager->getListDivisions();
			foreach ($divisions as $division) { ?>
				<option value="<?php echo $division->getDivNum() ?>"><?php echo $division->getDivNom() ?></option>
		<?php	}
			 ?>
		</select> <br/> <br/>
		Département : <select name="dep_num">
			<?php
			$departements = array();
			$departements = $departementManager->getListDepartements();
			foreach ($departements as $departement) { ?>
				<option value="<?php echo $departement->getDepNum() ?>"><?php echo $departement->getDepNom() ?></option>
		<?php	}
			 ?>
		</select> <br/> <br/>
		<input type="submit" name="" value="Valider">
	</form>

<?php } else if(!empty($_POST['per_sal'])){
?>

	<h1>Ajouter un salarié</h1>

<?php }
?>
