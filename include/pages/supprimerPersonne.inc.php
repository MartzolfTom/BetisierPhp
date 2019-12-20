<?php
  $db = new Mypdo();
  $personneManager = new PersonneManager($db);
  $salarieManager = new SalarieManager($db);
  $etudiantManager = new EtudiantManager($db);
  $personne = $personneManager->getDetailModifierPersonne($_GET['per_num']);
  $detailEtudiant = $etudiantManager->getDetailEtudiant($_GET['per_num']);

  if (empty($detailEtudiant)) {
    $salarieManager->retirerSalarie($_GET['per_num']);
  }
  else {
    $etudiantManager->retirerEtudiant($_GET['per_num']);
  }
  $personneManager->retirerPersonne($_GET['per_num']);
?>

<h3>L'étudiant <?php echo $personne->per_nom; ?> a bien été supprimé</h3>
