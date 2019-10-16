<?php
class ConnexionManager {

  public function __construct($db){
    $this->db=$db;
  }

  public function Login($mdp)
  {
    //on controle si le nom est valide dans notre base de donnees
    $per_login = trim($_SESSION['per_login']);
    $per_pwd = trim($mdp);
    if (nomPresentDansBase($per_login)) {

      $req1 = $this->db->prepare(
        'SELECT per_pwd FROM personne p WHERE per_login = :per_login'
      );
      $req1->bindValue(':per_login', $per_login, PDO::PARAM_STR);
      $personne1 = new Personne($req1->fetch(PDO::FETCH_OBJ));

      $req2 = $this->db->prepare(
        'SELECT per_pwd FROM  personne p WHERE per_login = :per_login AND per_pwd = :per_pwd'
      );
      $req2->bindValue(':per_login', $per_login, PDO::PARAM_STR);
      $req2->bindValue(':per_pwd', $per_pwd, PDO::PARAM_STR);
      $personne2 = new Personne($req2->fetch(PDO::FETCH_OBJ));


      if ($personne1->getPerPwd() == $personne2->getPerPwd()) {
        return true;
      }
      else {
        return false;
      }
    }
  }

  public function nomPresentDansBase($per_login){
    $sql = "SELECT per_nom FROM personne WHERE per_login = $per_login";
    $requete = $this->$db->query($sql);

    $personne = new Personne($requete->fetch(PDO::FETCH_OBJ));
    if (empty($personne)) {
      return false;
    }
    else {
      return true;
    }
  }
}
?>
