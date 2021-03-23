<?php
namespace models\Repository;
use models\Model;

class FileRepository extends Model {
    protected $table="Fichier";

    public function insert(array $fichier=array()){
        $req="INSERT INTO ".$this->table."(nom_fichier, id_user) VALUES (?,?)";
        $this->execReq($req,$fichier);
    }

    public function getAll(){
        $req="SELECT * FROM ".$this->table;
        return $this->execReq($req)->fetchAll();
    }

    public function updateStatus($fichier,$status){
        $sql="UPDATE ".$this->table." SET status='".$status."' WHERE id_fichier=?";
         $this->execReq($sql,[$fichier]);

    }

    public function getFile($id_file){
        $req="SELECT * FROM Fichier WHERE id_fichier=?";
         $result=$this->pdo->prepare($req);
         $result->execute(array($id_file));
       //$this->execReq($req,array($id_file));
       return  $result->fetch();
    }

    public function getFileValide(){
        $req="SELECT * FROM fichier WHERE status='valide'";
        return $this->execReq($req)->fetchAll();
    }

    public function getFileInvalide(){
        $req="SELECT * FROM fichier WHERE status='non valide'";
        return $this->execReq($req)->fetchAll();

    }


}

  