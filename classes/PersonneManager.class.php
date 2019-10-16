<?php

class PersonneManager{

public function __construct($db){
  $this ->db=$db;
}

public function ajouterPersonne($personne){
  $req=$this->db->prepare(
    'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd) VALUES(:per_nom, :per_prenom, :per_tel, :per_mail, 0, :per_login, :per_pwd)');
    $req->bindValue(':per_nom',$personne->getPerNom(),PDO::PARAM_STR);
    $req->bindValue(':per_prenom',$personne->getPerPrenom(),PDO::PARAM_STR);
    $req->bindValue(':per_tel',$personne->getPerTel(),PDO::PARAM_STR);
    $req->bindValue(':per_mail',$personne->getPerMail(),PDO::PARAM_STR);
    $req->bindValue(':per_login',$personne->getPerLogin(),PDO::PARAM_STR);
    $req->bindValue(':per_pwd',$personne->getPerPwd(),PDO::PARAM_STR);

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

public function getListEnseignant(){

  $listeEnseignant=array();
    $sql='SELECT per_nom FROM personne p join salarie s on p.per_num=s.per_num
                                         join fonction f on f.fon_num=s.fon_num
                                           WHERE fon_libelle=\'enseignant\'';

  $req= $this->db->query($sql);

  while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
    $listeEnseignant[] = new Personne($personne);

    return $listeEnseignant;
    $req->closeCursor();

}
}

}
 ?>
