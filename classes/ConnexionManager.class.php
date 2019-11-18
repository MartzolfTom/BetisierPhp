<?php
class ConnexionManager {

  public function __construct($db){
    $this->db=$db;
  }

  public function connexion($pwd, $per_login){
    $pwd_crypt = getPasswordCrypt($pwd);
    return $this->bonneConnexion($pwd_crypt, $per_login);
  }

  public function bonneConnexion($pwd_crypt, $per_login){
    $req = $this->db->prepare("SELECT per_num FROM personne WHERE per_pwd = :pwd_crypt AND per_login = :per_login");
    $req->bindValue(":pwd_crypt", $pwd_crypt, PDO::PARAM_STR);
    $req->bindValue(":per_login", $per_login, PDO::PARAM_STR);

    $req->execute();
    $lignePersonne = $req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();

    return $lignePersonne;
  }
}
?>
