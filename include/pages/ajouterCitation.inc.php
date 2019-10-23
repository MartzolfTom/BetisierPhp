<?php
$db = new Mypdo();
$managerCitation = new CitationManager($db);
$managerPersonne = new PersonneManager($db);
$listeCitation = $managerCitation->getListCitation();
$listeEnseignant = $managerPersonne->getListEnseignant();
?>

<h1>Ajouter une citation</h1>

<?php
if (empty($_POST['cit_libelle'])) {
    ?>
  <form method ="post" action ="#">

    Enseignant : <select size="1" name="per_num" value="Sarlat"/>  <?php
    foreach ($listeEnseignant as $personne) {
            ?>
        <option value= <?php echo $personne->getPerNum(); ?>>
        <?php echo $personne->getPerNom(); ?> </option> <?php
    }?>

     </select><br /><br />
    Date Citation : <input type="date" name="cit_date" value="2019-10-15"><br /><br />
    Citation : <textarea name="cit_libelle" cols="40" rows="5" >Et PATH le chemin !</textarea><br /><br />

        <input type="submit" name="Valider" />
  </form>
<?php } else {

    $tab = array('per_num' => $_POST['per_num'],
                 'cit_date' => $_POST['cit_date'],
                 'cit_libelle' => $_POST['cit_libelle'],
                 'per_num_etu' => 3,   // temporaire
                 'cit_date_depo' => $_POST['cit_date'],);

    $citation = new Citation($tab);

    $managerCitation->add($citation);
    echo "La citation a été ajouté";
}
?>
