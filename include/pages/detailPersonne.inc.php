<?php
$db = new Mypdo();
$managerPersonne = new PersonneManager($db);
$managerEtudiant = new EtudiantManager($db);
$managerSalarie = new SalarieManager($db);

$detailEtudiant = $managerEtudiant->getDetailEtudiant($_GET['per_num']);
$detailPersonne=$managerPersonne->getDetailPersonne($_GET['per_num']);
$detailSalarie=$managerSalarie->getDetailSalarie($_GET['per_num']);

if(!empty($detailEtudiant)){ ?>
<h1>Détail sur l'étudiant <?php echo $_GET['per_nom'] ?></h1>
<table>
 <tr>
   <th>Prénom</th>
   <th>Mail</th>
   <th>Tel</th>
   <th>Département</th>
   <th>Ville</th>
</tr>
<?php } else { ?>
  <h1>Détail sur le salarié <?php echo $_GET['per_nom'] ?></h1>
  <table>
   <tr>
     <th>Prénom</th>
     <th>Mail</th>
     <th>Tel</th>
     <th>Tel Pro</th>
     <th>Fonction</th>
  </tr>
 <?php } ?>
<tr>
  <?php
  foreach ($detailPersonne as $personne) { ?>
  <td > <?php echo $personne->getPerPrenom(); ?> </td>
  <td>  <?php echo $personne->getPerMail(); ?></td>
  <td>  <?php echo $personne->getPerTel(); ?></td>
<?php }
if(!empty($detailEtudiant)){ ?>
  <td><?php echo $detailEtudiant->dep_nom ?></td>
  <td><?php echo $detailEtudiant->vil_nom ?></td>
<?php
} else { ?>
  <td><?php echo $detailSalarie->sal_telprof ?></td>
  <td><?php echo $detailSalarie->fon_libelle ?></td>
<?php } ?>
</tr>
</table>
