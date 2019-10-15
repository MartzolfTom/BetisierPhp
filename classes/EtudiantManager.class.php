<?php

class EtudiantManager{

public function __construct($db){
  $this ->db=$db;
}


public function add($ville){
  $req=$this->db->prepare(
    'INSERT INTO ville ( vil_nom) VALUES(:nom)');
    $req->bindValue(':nom',$ville->getVilNom(),PDO::PARAM_STR);

    $req->execute();
}

public function getDetailEtudiant($per_num){

  $detailEtudiant =array();
  $sql='SELECT dep_nom, vil_nom  FROM etudiant e join departement d on e.dep_num=d.dep_num
                                                 join ville v on d.vil_num = v.vil_num
                                 WHERE e.per_num= '. $per_num .'';

  $req= $this->db->query($sql);

  while ($etudiant = $req->fetch(PDO::FETCH_OBJ)) {
    $detailEtudiant[] = new Etudiant($etudiant);

    return $detailEtudiant;
    $req->closeCursor();
  }
}

}
