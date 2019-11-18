<?php
class ConnexionManager {

  public function __construct($db){
    $this->db=$db;
  }

  public function connexion($pwd, $per_login){
    $pwd_crypt = getPasswordCrypt($pwd);
    return $this->bonneConnexion($pwd, $per_login);
  }

  public function bonneConnexion($pwd_crypt, $per_login){
    $req = $this->db->prepare("SELECT per_num FROM personne WHERE per_pwd = :pwd_crypt AND per_login = :per_login");
    $req->bindValue(":pwd_crypt", $pwd_crypt, PDO::PARAM_STR);
    $req->bindValue(":per_login", $per_login, PDO::PARAM_STR);

    $per_num = $req->fetch(PDO::FETCH_OBJ);

    return $per_num;
  }
}
?>
