<?php
class DivisionManager{
  public function __construct($db){
    $this->db = $db;
  }

  public function getListDivisions(){
    $divisions = array();
    $sql='SELECT div_num, div_nom FROM division ORDER BY div_num';

    $req = $this->db->query($sql);

    while ($division = $req->fetch(PDO::FETCH_OBJ)) {
      $divisions[] = new Division($division);
    }
    return $divisions;
    $req->closeCursor();
  }
}
 ?>
