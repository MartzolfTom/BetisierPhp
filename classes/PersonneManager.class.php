<?php

class PersonneManager{

public function __construct($db){
  $this ->db=$db;
}

public function ajouterPersonne($personneSerialized){
  $req=$this->db->prepare(
    'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd)
     VALUES(:per_nom, :per_prenom, :per_tel, :per_mail, 0, :per_login, :per_pwd)');

    $personne = unserialize($personneSerialized);
    $req->bindValue(':per_nom',$personne->getPerNom(),PDO::PARAM_STR);
    $req->bindValue(':per_prenom',$personne->getPerPrenom(),PDO::PARAM_STR);
    $req->bindValue(':per_tel',$personne->getPerTel(),PDO::PARAM_STR);
    $req->bindValue(':per_mail',$personne->getPerMail(),PDO::PARAM_STR);
    $req->bindValue(':per_login',$personne->getPerLogin(),PDO::PARAM_STR);
    $req->bindValue(':per_pwd',$personne->getPerPwd(),PDO::PARAM_STR);

    $req->execute();
}

public function modifierPersonne($personneSerialized, $per_num){
  $req=$this->db->prepare('UPDATE personne SET per_nom = :per_nom, per_prenom = :per_prenom, per_tel = :per_tel,
    per_mail = :per_mail, per_admin = 0, per_login = :per_login, per_pwd = :per_pwd
    WHERE per_num = :per_num');

  $personne = unserialize($personneSerialized);
  $req->bindValue(':per_nom',$personne->getPerNom(),PDO::PARAM_STR);
  $req->bindValue(':per_prenom',$personne->getPerPrenom(),PDO::PARAM_STR);
  $req->bindValue(':per_tel',$personne->getPerTel(),PDO::PARAM_STR);
  $req->bindValue(':per_mail',$personne->getPerMail(),PDO::PARAM_STR);
  $req->bindValue(':per_login',$personne->getPerLogin(),PDO::PARAM_STR);
  $req->bindValue(':per_pwd',$personne->getPerPwd(),PDO::PARAM_STR);
  $req->bindValue(':per_num',$per_num, PDO::PARAM_INT);

  $req->execute();
}

public function getListPersonnes(){

  $listePersonnes = array();
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

public function getNumPersonne($personneSerialized){
  $personne = unserialize($personneSerialized);

  $per_nom = $personne->getPerNom();
  $per_prenom = $personne->getPerPrenom();

  $sql= "SELECT * FROM personne WHERE per_nom = '$per_nom' AND per_prenom = '$per_prenom'";
  $req = $this->db->query($sql);
  $personne = $req->fetch(PDO::FETCH_OBJ);

  return $personne->per_num;
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
  }

    return $detailPersonne;
    $req->closeCursor();
}

public function getDetailModifierPersonne($per_num){
  $personne = array();
  $sql = 'SELECT per_nom, per_prenom, per_mail, per_tel, per_login, per_pwd FROM personne WHERE per_num = '. $per_num .'';

  $req = $this->db->query($sql);

  $personne = $req->fetch(PDO::FETCH_OBJ);
  return $personne;

  $req->closeCursor();
}

public function getListSalarie(){

  $listeSalarie=array();
  $sql='SELECT per_nom, p.per_num FROM personne p join salarie s on p.per_num=s.per_num';
  $req= $this->db->query($sql);

  while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
    $listeSalarie[] = new Personne($personne);
}
    return $listeSalarie;
    $req->closeCursor();

}

}
 ?>
