<?php

class SalarieManager{

public function __construct($db){
  $this ->db=$db;
}


public function add($ville){
  $req=$this->db->prepare(
    'INSERT INTO ville ( vil_nom) VALUES(:nom)');
    $req->bindValue(':nom',$ville->getVilNom(),PDO::PARAM_STR);

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
