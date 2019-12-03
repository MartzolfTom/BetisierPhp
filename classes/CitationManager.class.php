<?php

class CitationManager{

public function __construct($db){
  $this ->db=$db;
}

public function add($citation){
  $req=$this->db->prepare(
    'INSERT INTO citation (per_num,per_num_etu, cit_date, cit_libelle,cit_date_depo)
      VALUES(:num,:num_etu,:date,:libelle,:date_depo)');
    $req->bindValue(':num',$citation->getPerNum(),PDO::PARAM_INT);
    $req->bindValue(':date',$citation->getCitDate(),PDO::PARAM_STR );
    $req->bindValue(':num_etu',$citation->getPerNumEtu(),PDO::PARAM_INT );
    $req->bindValue(':libelle',$citation->getCitLibelle(),PDO::PARAM_STR);
    $req->bindValue(':date_depo',$citation->getCitDateDepo(),PDO::PARAM_STR);

    $req->execute();
}

public function getListCitationPasNotées($num_etu){

  $listeCitation =array();
  $sql='SELECT c.cit_num,concat(per_prenom,per_nom) as cit_personne_cité, cit_libelle, cit_date, avg(vot_valeur) as cit_moy_notes
        FROM citation c left join vote v ON c.cit_num=v.cit_num
                        join personne p on c.per_num=p.per_num
        where cit_valide=1 and cit_date_valide is not null  and c.cit_num not in ( Select cit_num from vote where per_num ='.$num_etu.')
        group by cit_personne_cité, cit_libelle, cit_date
        order by cit_date desc';
  $req= $this->db->query($sql);

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }

  return $listeCitation;
  $req->closeCursor();
}

public function getListCitationDejaNotées($num_etu){

  $listeCitation =array();
  $sql='SELECT c.cit_num,concat(per_prenom,per_nom) as cit_personne_cité, cit_libelle, cit_date, avg(vot_valeur) as cit_moy_notes
        FROM citation c left join vote v ON c.cit_num=v.cit_num
                        join personne p on c.per_num=p.per_num
        where cit_valide=1 and cit_date_valide is not null and c.cit_num in ( Select cit_num from vote where per_num ='.$num_etu.')
        group by cit_personne_cité, cit_libelle, cit_date
        order by cit_date desc';
  $req= $this->db->query($sql);

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }

  return $listeCitation;
  $req->closeCursor();
}

public function getAllListCitation(){

  $listeCitation =array();
  $sql='SELECT concat(per_prenom,per_nom) as cit_personne_cité, cit_libelle, cit_date, c.cit_num
        FROM citation c join personne p on c.per_num=p.per_num
        group by cit_personne_cité, cit_libelle, cit_date
        order by cit_date desc';
  $req= $this->db->query($sql);

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }

  return $listeCitation;
  $req->closeCursor();
}

public function getDetailCitation($cit_num){

  $sql='SELECT concat(per_prenom,per_nom) as cit_personne_cité, cit_libelle, cit_date, c.cit_num
        FROM citation c join personne p on c.per_num=p.per_num
        where c.cit_num ='.$cit_num.'
        group by cit_personne_cité, cit_libelle, cit_date
        order by cit_date desc';
  $req= $this->db->query($sql);

  $citation = $req->fetch(PDO::FETCH_OBJ);
  $detailCitation = new Citation($citation);

  return $detailCitation;
  $req->closeCursor();
}

public function supprimerCitation($citation){
  $req=$this->db->prepare('DELETE FROM citation WHERE cit_num= :num');
  $req->bindValue(':num',$citation->getCitNum(),PDO::PARAM_INT);

  $req->execute();
}

public function nbcitations(){
    $req=$this->db->query('SELECT count(cit_num) as nbcitations FROM citation
                           where cit_valide=1 and cit_date_valide is not null');
    $donnees=$req->fetch();
    $req->closeCursor();

    return $donnees['nbcitations'];
}

public function getDatePlusAncienne(){
    $req=$this->db->query('SELECT cit_date as datePlusAncienne FROM citation
                           having datePlusAncienne <=all(select cit_date from citation)');
    $donnees=$req->fetch();
    $req->closeCursor();

    return $donnees['datePlusAncienne'];
}


public function getListRechercheCitation($per_num,$cit_date_debut,$cit_date_fin,$cit_note_debut,$cit_note_fin){

  $listeCitation =array();
  $sql='SELECT c.cit_num,concat(per_prenom,per_nom) as cit_personne_cité, cit_libelle, cit_date, avg(vot_valeur) as cit_moy_notes
        FROM citation c join vote v ON c.cit_num=v.cit_num
                        join personne p on c.per_num=p.per_num
        where cit_valide=1
        and cit_date_valide is not null
        and c.per_num='.$per_num.'
        and cit_date between \''.$cit_date_debut.'\' and \''.$cit_date_fin.'\'
        group by cit_personne_cité, cit_libelle, cit_date,c.cit_num
        having avg(vot_valeur) between '.$cit_note_debut.' and '.$cit_note_fin.'
        order by cit_date desc';
  $req= $this->db->query($sql);

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }

  return $listeCitation;
  $req->closeCursor();
}


public function getListCitationNonValides(){

  $listeCitation =array();
  $sql='SELECT c.cit_num,concat(per_prenom,per_nom) as cit_personne_cité, cit_libelle, cit_date
        FROM citation c join personne p on c.per_num=p.per_num
        where cit_valide=0
        group by cit_personne_cité, cit_libelle, cit_date
        order by cit_date desc';
  $req= $this->db->query($sql);

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }
  return $listeCitation;
  $req->closeCursor();
 }

 public function validerCitation($cit_num,$per_num_valide){

   $req=$this->db->prepare('UPDATE citation set per_num_valide ='.$per_num_valide.',cit_valide = 1,cit_date_valide=NOW()
         WHERE cit_num='.$cit_num.'');

   $req->execute();
  }

  public function getDateJour(){
      $req=$this->db->query(' SELECT DATE( NOW() ) as dateJour');
      $donnees=$req->fetch();
      $req->closeCursor();

      return $donnees['dateJour'];
  }
}

 ?>
