<?php

class PersonneManager{

public function __construct($db){
  $this ->db=$db;
}

public function add($citation){
  $req=$this->db->prepare(
    'INSERT INTO ville ( vil_nom) VALUES(:nom)');
    $req->bindValue(':nom',$ville->getVilNom(),PDO::PARAM_STR);

    $req->execute();
}

public function getListPersonnes(){

  $listePersonnes =array();
  $sql='SELECT per_num, per_nom, per_prenom
        FROM personne
        order by per_num desc';
  $req= $this->db->query($sql);

  while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
    $listePersonnes[] = new Personne($personne);
  }

  return $listePersonnes;
  $req->closeCursor();
}


public function modifVille($ville){
      $req=$this->db->prepare(
      'UPDATE ville SET vil_num = :num, vil_nom = :nom WHERE vil_num= :num');
      $req->bindValue(':num',$ville->getVilNum(),PDO::PARAM_INT);
      $req->bindValue(':nom',$ville->getVilNom(),PDO::PARAM_STR);

      $req->execute();
}

public function supprVille($ville){
  $req=$this->db->prepare('DELETE FROM ville WHERE vil_num= :num');
  $req->bindValue(':num',$ville->getVilNum(),PDO::PARAM_INT);

  $req->execute();
}

public function nbpersonnes(){
    $req=$this->db->query('SELECT count(per_num) as nbpersonnes FROM personne');
    $donnees=$req->fetch();
    $req->closeCursor();

    return $donnees['nbpersonnes'];
}

public function getDetailPersonne($per_num){

  $detailPersonne =array();
  $sql='SELECT per_prenom, per_mail , per_tel   FROM personne
                                 WHERE per_num= '. $per_num .'';

  $req= $this->db->query($sql);

  while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
    $detailPersonne[] = new Personne($personne);

    return $detailPersonne;
    $req->closeCursor();
  }
}

}
 ?>