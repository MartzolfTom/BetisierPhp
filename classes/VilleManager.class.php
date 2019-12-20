<?php

class VilleManager{

public function __construct($db){
  $this ->db=$db;
}

public function add($ville){
  $req=$this->db->prepare(
    'INSERT INTO ville ( vil_nom) VALUES(:nom)');
    $req->bindValue(':nom',$ville->getVilNom(),PDO::PARAM_STR);

    $req->execute();
}

public function getListVille(){

  $listeVille =array();
  $sql='SELECT vil_num, vil_nom FROM ville ORDER BY vil_num desc';
  $req= $this->db->query($sql);

  while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
    $listeVille[] = new Ville($ville);
  }

  return $listeVille;
  $req->closeCursor();
}

public function getListVilleASupprimer(){

  $listeVille =array();
  $sql='SELECT vil_num, vil_nom FROM ville
        WHERE vil_num not in ( SELECT v.vil_num from ville v join departement d on v.vil_num=d.vil_num)
        ORDER BY vil_num desc';
  $req= $this->db->query($sql);

  while ($ville = $req->fetch(PDO::FETCH_OBJ)) {
    $listeVille[] = new Ville($ville);
  }

  return $listeVille;
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

public function nomVille($vil_num){
    $req=$this->db->query('SELECT vil_nom as nom FROM ville WHERE vil_num='.$vil_num.'');
    $donnees=$req->fetch();
    $req->closeCursor();

    return $donnees['nom'];
}

public function nbVille(){
    $req=$this->db->query('SELECT count(vil_num) as nbVille FROM ville');
    $donnees=$req->fetch();
    $req->closeCursor();

    return $donnees['nbVille'];
}

}
 ?>
