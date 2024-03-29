<?php
class Etudiant
{

    private $per_num;
    private $dep_num;
    private $div_num;

    private $dep_nom;
    private $vil_nom;

    public function __construct($valeurs = array())
    {
        if (!empty($valeurs)) {
            $this->affecte($valeurs);
        }
    }

    public function affecte($valeurs)
    {
        foreach ($valeurs as $attribut => $valeur) {
            switch ($attribut) {
                case 'per_num':
                    $this->setPerNum($valeur);
                    break;
                case 'dep_num':
                    $this->setDepNum($valeur);
                    break;
                case 'div_num':
                    $this->setDivNum($valeur);
                    break;
                case 'dep_nom':
                    $this->setDepNom($valeur);
                    break;
                case 'vil_nom':
                    $this->setVilNom($valeur);
                    break;
            }
        }
      }


    public function getPerNum()
    {
        return $this->per_num;
    }

    public function setPerNum($per_num)
    {
        $this->per_num = $per_num;

        return $this;
    }

    public function getDepNum()
    {
        return $this->dep_num;
    }

    public function setDepNum($dep_num)
    {
        $this->dep_num = $dep_num;

        return $this;
    }

    public function getDivNum()
    {
        return $this->div_num;
    }

    public function setDivNum($div_num)
    {
        $this->div_num = $div_num;

        return $this;
    }

    public function getDepNom()
    {
        return $this->dep_nom;
    }

    public function setDepNom($dep_nom)
    {
        $this->dep_nom = $dep_nom;

        return $this;
    }

    public function getVilNom()
    {
        return $this->vil_nom;
    }


    public function setVilNom($vil_nom)
    {
        $this->vil_nom = $vil_nom;

        return $this;
    }

}
