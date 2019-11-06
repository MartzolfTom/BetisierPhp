<?php

class SalarieManager{

public function __construct($db){
  $this ->db=$db;
}

public function ajouterSalarie($salarie){
  $req=$this->db->prepare(
    'INSERT INTO salarie VALUES(:per_num, :sal_telprof, :fon_num)');
    $req->bindValue(':per_num',$salarie->getPerNum(),PDO::PARAM_INT);
    $req->bindValue(':sal_telprof',$salarie->getSalTelprof(),PDO::PARAM_STR);
    $req->bindValue(':fon_num',$salarie->getFonNum(),PDO::PARAM_STR);

    $req->execute();
}

public function retirerSalarie($per_num){
  $req=$this->db->prepare('DELETE FROM salarie WHERE per_num = :per_num');
  $req->bindValue(':per_num', $per_num, PDO::PARAM_INT);

  $req->execute();
}

public function modifierSalarie($salarie){
  $req=$this->db->prepare(
    'UPDATE salarie SET sal_telprof = :sal_telprof, fon_num = :fon_num WHERE per_num = :per_num');
    $req->bindValue(':per_num', $etudiant->getPerNum(), PDO::PARAM_INT);
    $req->bindValue(':sal_telprof', $salarie->getSalTelprof(), PDO::PARAM_STR);
    $req->bindValue(':fon_num', $salarie->getFonNum(), PDO::PARAM_STR);

    $req->execute();
}

public function getDetailSalarie($per_num){

  $detailSalarie =array();
  $sql='SELECT sal_telprof, fon_libelle FROM salarie s join fonction f on s.fon_num=f.fon_num
                                         WHERE s.per_num= '. $per_num .'';

  $req= $this->db->query($sql);

  while ($salarie = $req->fetch(PDO::FETCH_OBJ)) {
    $detailSalarie[] = new Salarie($salarie);

    return $detailSalarie;
    $req->closeCursor();
  }
}

}
