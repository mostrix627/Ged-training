<?php
namespace models\Entity;

class File {

    private $id_fichier;
    private $nom_fichier;
    private $status;

    public function __construct(){

    }

    public function getId(){
        return $this->id_fichier;
    }

    public function getNom(){
        return $this->nom_fichier;
    }

    public function getStatus(){
        return $this->status;
    }
    public function setId($id){
        $this->id_fichier=$id;
        return $this->id_fichier;
    }

    public function setNom($nom){
        $this->nom_fichier=$nom;
        return  $this->nom_fichier;
    }

    public function setStatus($status){
        $this->status=$status;
        return  $this->status;
    }

}