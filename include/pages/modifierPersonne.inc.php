<?php
$db = new Mypdo();
$divisionManager = new DivisionManager($db);
$departementManager = new DepartementManager($db);
$personneManager = new PersonneManager($db);
$etudiantManager = new EtudiantManager($db);
$salarieManager = new SalarieManager($db);
$fonctionManager = new FonctionManager($db);

$salt = "48@!alsd";
$per_num = $_GET['per_num'];

$detailsEtudiant = $etudiantManager->getDetailEtudiant($per_num);
$detailsSalarie = $salarieManager->getDetailSalarie($per_num);

if(empty($_POST['etudiant']) && empty($_POST['salarie']) && empty($_POST['div_num']) && empty($_POST['dep_num']) && empty($_POST['fon_num'])) {

$detailsPersonne = $personneManager->getDetailModifierPersonne($per_num);
?>

<h1>Modifier une personne</h1>
<form action="#" method="post">
  Nom : <input type="text" name="per_nom" value="<?php echo $detailsPersonne->per_nom ?>"> <br/> <br/>
  Prénom : <input type="text" name="per_prenom" value="<?php echo $detailsPersonne->per_prenom ?>"> <br/> <br/>
  Téléphone : <input type="text" name="per_tel" value="<?php echo $detailsPersonne->per_tel ?>"> <br/> <br/>
  Mail : <input type="text" name="per_mail" value="<?php echo $detailsPersonne->per_mail ?>"> <br/> <br/>
  Login : <input type="text" name="per_login" value="<?php echo $detailsPersonne->per_login ?>"> <br/> <br/>
  Mot de passe : <input type="text" name="per_pwd" value=""> <br/> <br/>
  Catégorie : <input type="radio" name="etudiant" value="etu"> Etudiant
  <input type="radio" name="salarie" value="sal"> Salarie <br/> <br/>
  <input type="submit" name="" value="Valider">
</form>

<?php } else if (!empty($_POST['etudiant'])) {

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
	<h1>Modifier un étudiant</h1>
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

<!--Apres avoir valider l'etudiant, on modifie dans les tables personne et etudiant les donnes-->
<?php } else if (!empty($_POST['div_num'])){

$personneManager->modifierPersonne($_SESSION['personne'], $per_num);

$etudiant = new Etudiant(
						array(
							'per_num' => $per_num,
							'dep_num' => $_POST['dep_num'],
							'div_num' => $_POST['div_num']
						)
);

//selon si la personne est deja un etudiant ou non
//on applique les changements adequats
if (!empty($detailsEtudiant)) {
  $etudiantManager->modifierEtudiant($etudiant);
}
else {
  $salarieManager->retirerSalarie($per_num);
  $etudiantManager->ajouterEtudiant($etudiant);
}

//on n'oublie pas de libere le cookie personne maintenant inutile
unset($_SESSION['personne']);

?>
L'Etudiant a bien été modifié !


<!--Cas ou l'on choisi salarie-->
<?php } else if (!empty($_POST['salarie'])){
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
	<h1>Modifier un salarié</h1>

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

$personneManager->modifierPersonne($_SESSION['personne'], $per_num);

$sal_telprof = $_POST['sal_telprof'];

$salarie = new Salarie(
						array(
							'per_num' => $per_num,
							'sal_telprof' => $sal_telprof,
							'fon_num' => $_POST['fon_num']
						)
);

//si la personne est deja salarie ou non
//on applique les changements adequats
if (!empty($detailSalarie)) {
  $salarieManager->modifierSalarie($salarie);
}
else {
  $etudiantManager->retirerEtudiant($per_num);
  $salarieManager->ajouterSalarie($salarie);
}

//on n'oublie pas de liberer le cookie personne maintenant inutile
unset($_SESSION['personne']);
?>
Le salarie a bien été modifié !!

<?php
}
?>
