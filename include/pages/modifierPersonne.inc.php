<?php
$db = new Mypdo();
$divisionManager = new DivisionManager($db);
$departementManager = new DepartementManager($db);
$personneManager = new PersonneManager($db);
$etudiantManager = new EtudiantManager($db);
$salarieManager = new SalarieManager($db);
$fonctionManager = new FonctionManager($db);

$_SESSION['per_num'] = $_GET['per_num'];

$detailsEtudiant = $etudiantManager->getDetailEtudiant($_SESSION['per_num']);
$detailsSalarie = $salarieManager->getDetailSalarie($_SESSION['per_num']);

if(empty($_POST['fonction']) && empty($_POST['div_num']) && empty($_POST['dep_num']) && empty($_POST['fon_num'])) {

  $detailsPersonne = $personneManager->getDetailModifierPersonne($_SESSION['per_num']); ?>

  <h1>Modifier une personne</h1>
  <form action="#" method="post">
    Nom : <input type="text" name="per_nom" value="<?php echo $detailsPersonne->per_nom ?>"> <br/> <br/>
    Prénom : <input type="text" name="per_prenom" value="<?php echo $detailsPersonne->per_prenom ?>"> <br/> <br/>
    Téléphone : <input type="text" name="per_tel" value="<?php echo $detailsPersonne->per_tel ?>"> <br/> <br/>
    Mail : <input type="text" name="per_mail" value="<?php echo $detailsPersonne->per_mail ?>"> <br/> <br/>
    Login : <input type="text" name="per_login" value="<?php echo $detailsPersonne->per_login ?>"> <br/> <br/>
    Mot de passe : <input type="password" name="per_pwd" value=""> <br/> <br/>
    Catégorie : <input type="radio" name="fonction" value="etu"> Etudiant
    <input type="radio" name="fonction" value="sal"> Salarie <br/> <br/>
    <input type="submit" value="Valider">
  </form>

<?php } else if (!empty($_POST['fonction']) && !empty($_POST['per_nom']) && !empty($_POST['per_pwd'])
								&& !empty($_POST['per_tel']) && !empty($_POST['per_mail']) && !empty($_POST['per_login'])) {

  $pwd = $_POST['per_pwd'];
  $pwd_crypte = getPasswordCrypt($pwd);

  creerPersonne($pwd_crypte);

  if ($_POST['fonction'] == "etu") { ?>
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
        <input type="submit" value="Valider">
        </form>
  <?php } else { ?>
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
    <input type="submit" value="Valider">
  </form>

  <?php } ?>

<!--Apres avoir valider l'etudiant, on modifie dans les tables personne et etudiant les donnes-->
<?php } else if (!empty($_POST['div_num'])){

  $personneManager->modifierPersonne($_SESSION['personne'], $_SESSION['per_num']);

  $etudiant = new Etudiant(
  						array(
  							'per_num' => $_SESSION['per_num'],
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
    $salarieManager->retirerSalarie($_SESSION['per_num']);
    $etudiantManager->ajouterEtudiant($etudiant);
  }

  //on n'oublie pas de libere le cookie personne et per_num maintenant inutile
  unset($_SESSION['personne']);
  unset($_SESSION['per_num']); ?>

  L'Etudiant a bien été modifié !

<!--Après avoir valider le salarie, on enregistre les donnees dans notre base de donnees-->
<?php } else if(!empty($_POST['fon_num'])){

  $personneManager->modifierPersonne($_SESSION['personne'], $_SESSION['per_num']);

  $sal_telprof = $_POST['sal_telprof'];

  $salarie = new Salarie(
  						array(
  							'per_num' => $_SESSION['per_num'],
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
    $etudiantManager->retirerEtudiant($_SESSION['per_num']);
    $salarieManager->ajouterSalarie($salarie);
  }

  //on n'oublie pas de liberer le cookie personne maintenant inutile
  unset($_SESSION['personne']);
  unset($_SESSION['per_num']); ?>

  Le salarie a bien été modifié !!

<?php } else {

	header("Refresh: 2; url=index.php?page=3");?>
	Vous n'avez pas rentré les champs correctement !
	Redirection dans 2 secondes

<?php } ?>
