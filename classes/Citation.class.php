<?php
class Citation
{

    private $cit_num;
    private $per_num;
    private $per_num_valide;
    private $per_num_etu;
    private $cit_libelle;
    private $cit_date;
    private $cit_valide;
    private $cit_date_valide;
    private $cit_date_depo;

    private $cit_personne_cité;
    private $cit_moy_notes;

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
                case 'cit_num':
                    $this->setCitNum($valeur);
                    break;
                case 'per_num':
                    $this->setPerNum($valeur);
                    break;
                case 'per_num_valide':
                    $this->setPerNumValide($valeur);
                    break;
                case 'per_num_etu':
                    $this->setPerNumEtu($valeur);
                    break;
                case 'cit_libelle':
                    $this->setCitLibelle($valeur);
                    break;
                case 'cit_date':
                    $this->setCitDate($valeur);
                    break;
                case 'cit_valide':
                    $this->setCitValide($valeur);
                    break;
                case 'cit_date_valide':
                    $this->setCitDateValide($valeur);
                    break;
                case 'cit_date_depo':
                    $this->setCitDateDepo($valeur);
                    break;
                case 'cit_personne_cité':
                    $this->setCitPersonneCit($valeur);
                    break;
                case 'cit_moy_notes':
                    $this->setCitMoyNotes($valeur);
                      break;
            }
        }
    }

    public function getCitNum()
    {
        return $this->cit_num;
    }

    public function setCitNum($cit_num)
    {
        $this->cit_num = $cit_num;

        return $this;
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

    public function getPerNumValide()
    {
        return $this->per_num_valide;
    }

    public function setPerNumValide($per_num_valide)
    {
        $this->per_num_valide = $per_num_valide;

        return $this;
    }

    public function getPerNumEtu()
    {
        return $this->per_num_etu;
    }

    public function setPerNumEtu($per_num_etu)
    {
        $this->per_num_etu = $per_num_etu;

        return $this;
    }

    public function getCitLibelle()
    {
        return $this->vit_libelle;
    }

    public function setCitLibelle($vit_libelle)
    {
        $this->vit_libelle = $vit_libelle;

        return $this;
    }

    public function getCitDate()
    {
        return $this->cit_date;
    }

    public function setCitDate($cit_date)
    {
        $this->cit_date = $cit_date;

        return $this;
    }

    public function getCitValide()
    {
        return $this->cit_valide;
    }

    public function setCitValide($cit_valide)
    {
        $this->cit_valide = $cit_valide;

        return $this;
    }

    public function getCitDateValide()
    {
        return $this->cit_date_valide;
    }

    public function setCitDateValide($cit_date_valide)
    {
        $this->cit_date_valide = $cit_date_valide;

        return $this;
    }

    public function getCitDateDepo()
    {
        return $this->cit_date_depo;
    }

    public function setCitDateDepo($cit_date_depo)
    {
        $this->cit_date_depo = $cit_date_depo;

        return $this;
    }

    public function getCitPersonneCit()
    {
        return $this->cit_personne_cité;
    }

    public function getCitMoyNotes()
    {
        return $this->cit_moy_notes;
    }

    public function setCitPersonneCit($cit_personne_cité)
    {
        $this->cit_personne_cité = $cit_personne_cité;

        return $this;
    }

    public function setCitMoyNotes($cit_moy_notes)
    {
        $this->cit_moy_notes = $cit_moy_notes;

        return $this;
    }

}
