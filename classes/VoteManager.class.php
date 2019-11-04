<?php

class VoteManager{

public function __construct($db){
  $this ->db=$db;
}

public function ajouterNote($vote){
  $req=$this->db->prepare(
    'INSERT INTO vote ( cit_num,per_num,vot_valeur) VALUES(:citnum,:pernum,:vote)');
    $req->bindValue(':citnum',$vote->getCitNum(),PDO::PARAM_INT);
    $req->bindValue(':pernum',$vote->getPerNum(),PDO::PARAM_INT);
    $req->bindValue(':vote',$vote->getVotValeur(),PDO::PARAM_INT);
    
    $req->execute();
}

}
 ?>
