<?php
class MotsManager{
  public function __construct($db){
    $this->db = $db;
  }

  public function getListeMotsInterdits($libelle){
    $motsInterdits = array();

    $req = $this->db->prepare('SELECT mot_interdit FROM mot WHERE MATCH(mot_interdit) AGAINST(:libelle)');
    $req->bindValue(":libelle", $libelle, PDO::PARAM_STR);

    $req->execute();
    while ($motInterdit = $req->fetch(PDO::FETCH_OBJ)) {
      $motsInterdits[] = $motInterdit->mot_interdit;
    }
    $req->closeCursor();

    return $motsInterdits;
  }
}
 ?>
