<?php
$db = new Mypdo();
$divisionManager = new DivisionManager($db);
$departementManager = new DepartementManager($db);
$personneManager = new PersonneManager($db);
$etudiantManager = new EtudiantManager($db);
$salarieManager = new SalarieManager($db);
$fonctionManager = new FonctionManager($db);

if (empty($_POST['fonction']) && empty($_POST['div_num']) && empty($_POST['dep_num']) && empty($_POST['fon_num'])) { ?>

	<h1>Ajouter une personne</h1>
	<form action="#" method="post">
		Nom : <input type="text" name="per_nom" value="Mare"> <br/> <br/>
		Prénom : <input type="text" name="per_prenom" value="Dorian"> <br/> <br/>
		Téléphone : <input type="text" name="per_tel" value="0629107479"> <br/> <br/>
		Mail : <input type="text" name="per_mail" value="dorianmare@yahoo.fr"> <br/> <br/>
		Login : <input type="text" name="per_login" value="MichouDu87"> <br/> <br/>
		Mot de passe : <input type="password" name="per_pwd" value="Rahnon"> <br/> <br/>
		Catégorie : <input type="radio" name="fonction" value="etu"> Etudiant
		<input type="radio" name="fonction" value="sal"> Salarie <br/> <br/>
		<input type="submit" value="Valider">
	</form>

<!--Si l'on choisis etudiant ou salarie et que l'on a bien rentre les champs-->
<?php } else if (!empty($_POST['fonction']) && !empty($_POST['per_nom']) && !empty($_POST['per_pwd'])
								&& !empty($_POST['per_tel']) && !empty($_POST['per_mail']) && !empty($_POST['per_login'])) {
	if (!empty($personneManager->getLogin($_POST['per_login']))) { ?>
		<p>Ce login est déjà pris !!</p>
	<?php
	} else {

		$pwd = $_POST['per_pwd'];
		$pwd_crypte = getPasswordCrypt($pwd);

		creerPersonne($pwd_crypte);

		if ($_POST['fonction']=="etu") { ?>
			<h1>Ajouter un étudiant</h1>
			<form action="#" method="post">
				Année : <select name="div_num">
					<?php
					$listeDivisions = $divisionManager->getListDivisions();
					foreach ($listeDivisions as $division) { ?>
						<option value="<?php echo $division->getDivNum() ?>"><?php echo $division->getDivNom() ?></option>
					<?php	}
					?>
				</select> <br/> <br/>
				Département : <select name="dep_num">
					<?php
					$listeDepartements = $departementManager->getListDepartements();
					foreach ($listeDepartements as $departement) { ?>
						<option value="<?php echo $departement->getDepNum() ?>"><?php echo $departement->getDepNom() ?></option>
					<?php	}
					?>
				</select> <br/> <br/>
				<input type="submit" name="" value="Valider">
			</form>
		<?php } else { ?>
			<h1>Ajouter un salarié</h1>

			<form action="#" method="post">
				Téléphone professionel : <input type="text" name="sal_telprof" value="0506070810"> <br/> <br/>
				Fonction : <select name="fon_num">
					<?php
					$listeFonctions = $fonctionManager->getListFonctions();
					foreach ($listeFonctions as $fonction) { ?>
						<option value="<?php echo $fonction->getFonNum() ?>"><?php echo $fonction->getFonLibelle() ?></option>
					<?php	}
					?>
				</select> <br/> <br/>
				<input type="submit" name="" value="Valider">
			</form>
		<?php }
	}


//Apres avoir valider l'etudiant, on enregistre dans les tables personne et etudiant les donnees
} else if (!empty($_POST['div_num'])) {

	$personneManager->ajouterPersonne($_SESSION['personne']);

	//on recupere le per_num de la nouvel personne
	$per_num = $personneManager->getNumPersonne($_SESSION['personne']);

	$etudiant = new Etudiant(
							array(
								'per_num' => $per_num,
								'dep_num' => $_POST['dep_num'],
								'div_num' => $_POST['div_num']
							)
	);

	$etudiantManager->ajouterEtudiant($etudiant);

	//on n'oublie pas de libere le cookie personne maintenant inutile
	unset($_SESSION['personne']); ?>

	L'Etudiant a bien été ajouté !

<!--Apres avoir valider le salarie, on enregistre dans les tables personne et salarie les donnees-->
<?php } else if(!empty($_POST['fon_num'])){

	$personneManager->ajouterPersonne($_SESSION['personne']);

	//on recupere le per_num de la nouvel personne
	$per_num = $personneManager->getNumPersonne($_SESSION['personne']);
	$sal_telprof = $_POST['sal_telprof'];

	$salarie = new Salarie(
							array(
								'per_num' => $per_num,
								'sal_telprof' => $sal_telprof,
								'fon_num' => $_POST['fon_num']
							)
	);
	$salarieManager->ajouterSalarie($salarie);
	//on n'oublie pas de liberer le cookie personne maintenant inutile
	unset($_SESSION['personne']); ?>

	Le salarie a bien été rajouté !!

<?php } else {

	header("Refresh: 2; url=index.php?page=2");?>
	Vous n'avez pas rentré les champs correctement, ou un login déjà existant !
	Redirection dans 2 secondes

<?php } ?>
