<?php
namespace App\generator;
use App\Repository\MedecinRepository;

class matriculeGenerator{

    private $matricule; 

    public function __construct(MedecinRepository $medRepo)
    {
        $mat_format = "00000";
        $lastMedecin = $medRepo ->findOneBy([],['id'=>'desc']);

        if($lastMedecin !=null){

            $lastId = $lastMedecin->getId();
            $this->matricule = substr($mat_format, 0, -strlen($lastId)).((int)$lastId + 1);
        }else{
             $this->matricule = substr($mat_format,0,-1).'1';
        }

    }
    public function generate(){

        return $this->matricule;
    }
}




?>