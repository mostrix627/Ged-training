<?php
namespace models\Repository;
use models\Model;

class FileRepository extends Model {
    protected $table="Fichier";

    public function insert(array $fichier=array()){
        $req="INSERT INTO ".$this->table."(nom_fichier, id_user) VALUES (?,?)";
        $r=$this->pdo->prepare($req);
        var_dump($r);
        $r->execute($fichier);
    }

    public function getAll(){
        $req="SELECT * FROM ".$this->table;
        $result=$this->pdo->query($req);
        return $result->fetchAll();
    }
}