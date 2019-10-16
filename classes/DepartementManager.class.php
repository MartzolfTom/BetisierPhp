<?php
class DepartementManager{
  public function __construct($db){
    $this->db = $db;
  }

  public function getListDepartements(){
    $departements = array();
    $sql='SELECT dep_num, dep_nom FROM departement ORDER BY dep_num';

    $req = $this->db->query($sql);

    while ($departement = $req->fetch(PDO::FETCH_OBJ)) {
      $departements[] = new Departement($departement);
    }
    return $departements;
    $req->closeCursor();
  }
}
 ?>
