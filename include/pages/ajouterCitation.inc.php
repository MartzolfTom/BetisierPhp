<?php
$db = new Mypdo();
$managerCitation = new CitationManager($db);
$managerPersonne = new PersonneManager($db);
$managerMots = new MotsManager($db);
$listeSalarie = $managerPersonne->getListSalarie();
?>

<h1>Ajouter une citation</h1>

<?php
if (empty($_POST['cit_libelle'])) {
?>
  <form method ="post" action ="#">

    Salarie : <select size="1" name="per_num"/>  <?php foreach ($listeSalarie as $personne){ ?>
      <option value= <?php echo $personne->getPerNum();?> > <?php echo $personne->getPerNom(); ?></option>
    <?php } ?>
    </select><br/><br/>
    Date Citation : <input type="date" name="cit_date" value="2019-10-15"><br /><br />
    Citation : <textarea name="cit_libelle" cols="40" rows="5" >Et PATH le chemin !</textarea><br /><br />

    <input type="submit" name="Valider"/>
  </form>
<?php

} else {

  $_SESSION['listeMotsInterdits'] = $managerMots->getListeMotsInterdits($_POST['cit_libelle']);

  //on regarde si des mots interdits on ete trouves
  if (!empty($_SESSION['listeMotsInterdits'])) {
    $motsInterdits = $_SESSION['listeMotsInterdits'];
    $nouveauLibelle = str_replace($motsInterdits, "---", $_POST['cit_libelle']);
    ?>

    <p>Le ou les mots <?php
      foreach ($_SESSION['listeMotsInterdits'] as $mot) {
        echo $mot.' ';
      }
    ?> ne sont pas valables !!</p><br/>
    <form method ="post" action ="#">

      Salarie : <select size="1" name="per_num"/>  <?php foreach ($listeSalarie as $personne){ ?>
        <option value= <?php echo $personne->getPerNum();?> > <?php echo $personne->getPerNom(); ?></option>
      <?php } ?>
      </select><br/><br/>
      Date Citation : <input type="date" name="cit_date" value="2019-10-15"><br /><br />
      Citation : <textarea name="cit_libelle" cols="40" rows="5" ><?php echo $nouveauLibelle ?></textarea><br /><br />

      <input type="submit" name="Valider"/>
    </form>
  <?php }
  //si aucun mots interdits n'a ete trouves, on ajoute la citation
  else {
  $tab = array('per_num' => $_POST['per_num'],
               'cit_date' => $_POST['cit_date'],
               'cit_libelle' => $_POST['cit_libelle'],
               'per_num_etu' => $_SESSION['per_num'],
               'cit_date_depo' => $_POST['cit_date'],);

  $citation = new Citation($tab);

  $managerCitation->add($citation);
  echo "La citation a été ajouté";
  }
}
?>
