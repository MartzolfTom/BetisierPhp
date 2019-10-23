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

if(empty($_POST['etudiant']) && empty($_POST['salarie']) && empty($_POST['div_num']) && empty($_POST['dep_num']) && empty($_POST['fon_num'])) {
?>

<h1>Modifier une personne</h1>
<form action="#" method="post">
  Nom : <input type="text" name="per_nom" value=""> <br/> <br/>
  Prénom : <input type="text" name="per_prenom" value=""> <br/> <br/>
  Téléphone : <input type="text" name="per_tel" value=""> <br/> <br/>
  Mail : <input type="text" name="per_mail" value=""> <br/> <br/>
  Login : <input type="text" name="per_login" value=""> <br/> <br/>
  Mot de passe : <input type="text" name="per_pwd" value=""> <br/> <br/>
  Catégorie : <input type="radio" name="etudiant" value=""> Etudiant
  <input type="radio" name="salarie" value=""> Salarie <br/> <br/>
  <input type="submit" name="" value="Valider">
</form>

<?php
}
?>
