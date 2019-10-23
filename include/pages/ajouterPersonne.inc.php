<?php
session_start();

$db = new Mypdo();
$divisionManager = new DivisionManager($db);
$departementManager = new DepartementManager($db);
$personneManager = new PersonneManager($db);
$etudiantManager = new EtudiantManager($db);
$salarieManager = new SalarieManager($db);
$fonctionManager = new FonctionManager($db);

if (empty($_POST['type']) && empty($_POST['div_num']) && empty($_POST['dep_num']) && empty($_POST['fon_num'])) {
?>
	<h1>Ajouter une personne</h1>
	<form action="#" method="post">
		Nom : <input type="text" name="per_nom" value="Mare"> <br/> <br/>
		Prénom : <input type="text" name="per_prenom" value="Dorian"> <br/> <br/>
		Téléphone : <input type="text" name="per_tel" value="0629107479"> <br/> <br/>
		Mail : <input type="text" name="per_mail" value="dorianmare@yahoo.fr"> <br/> <br/>
		Login : <input type="text" name="per_login" value="MichouDu87"> <br/> <br/>
		Mot de passe : <input type="text" name="per_pwd" value="Rahnon"> <br/> <br/>
		Catégorie : <input type="radio" name="type" value="etudiant"> Etudiant
		<input type="radio" name="type" value="salarie"> Salarie <br/> <br/>
		<input type="submit" name="" value="Valider">
	</form>

<!--Si l'on choisis etudiant-->
<?php } else if ($_POST['type'] == 'etudiant') {

$salt = "48@!alsd";
$pwd = $_POST['per_pwd'];
$pwd_crypte = sha1(sha1($pwd) . $salt);

$_SESSION['personne'] = new Personne(
							array('per_nom' => $_POST['per_nom'],
							'per_prenom' => $_POST['per_prenom'],
							'per_tel' => $_POST['per_tel'],
					    'per_mail' => $_POST['per_mail'],
					    'per_login' => $_POST['per_login'],
							'per_pwd' => $pwd_crypte)
);

?>
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

<!--Apres avoir valider l'etudiant, on enregistre dans les tables personne et etudiant les donnes-->
<?php } else if (!empty($_POST['div_num'])){

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
unset($_SESSION['personne']);

?>
L'Etudiant a bien été ajouté !

<!--Cas ou l'on choisi salarie-->
<?php } else if ($_POST['type'] == 'salarie'){
$salt = "48@!alsd";
$pwd = $_POST['per_pwd'];
$pwd_crypte = sha1(sha1($pwd) . $salt);

$_SESSION['personne'] = new Personne(
							array('per_nom' => $_POST['per_nom'],
							'per_prenom' => $_POST['per_prenom'],
							'per_tel' => $_POST['per_tel'],
					    'per_mail' => $_POST['per_mail'],
					    'per_login' => $_POST['per_login'],
							'per_pwd' => $pwd_crypte)
);

?>
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

<!--Après avoir valider le salarie, on enregistre les donnees dans notre base de donnees-->
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

//on n'oublie pas de libere le cookie personne maintenant inutile
//unset($_SESSION['personne']);
?>
Le salarie a bien été rajouté !!

<?php
}
?>
