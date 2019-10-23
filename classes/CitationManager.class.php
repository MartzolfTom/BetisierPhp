<?php

class CitationManager{

public function __construct($db){
  $this ->db=$db;
}

public function add($citation){
  $req=$this->db->prepare(
    'INSERT INTO citation (per_num,per_num_etu, cit_date, cit_libelle,cit_date_depo)
      VALUES(:num,:num_etu,:date,:libelle,:date_depo)');
    $req->bindValue(':num',$citation->getPerNum(),PDO::PARAM_INT);
    $req->bindValue(':date',$citation->getCitDate(),PDO::PARAM_STR );
    $req->bindValue(':num_etu',$citation->getPerNumEtu(),PDO::PARAM_INT );
    $req->bindValue(':libelle',$citation->getCitLibelle(),PDO::PARAM_STR);
    $req->bindValue(':date_depo',$citation->getCitDateDepo(),PDO::PARAM_STR);

    $req->execute();
}

public function getListCitation(){

  $listeCitation =array();
  $sql='SELECT concat(per_prenom,per_nom) as cit_personne_cité, cit_libelle, cit_date, avg(vot_valeur) as cit_moy_notes
        FROM citation c join vote v ON c.cit_num=v.cit_num
                        join personne p on c.per_num=p.per_num
        where cit_valide=1 and cit_date_valide is not null
        group by cit_personne_cité, cit_libelle, cit_date
        order by cit_date desc';
  $req= $this->db->query($sql);

  while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
    $listeCitation[] = new Citation($citation);
  }

  return $listeCitation;
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

public function nbcitations(){
    $req=$this->db->query('SELECT count(cit_num) as nbcitations FROM citation
                           where cit_valide=1 and cit_date_valide is not null');
    $donnees=$req->fetch();
    $req->closeCursor();

    return $donnees['nbcitations'];
}

}
 ?>
