<?php
namespace Models;

use \tools\Database;

abstract class Model{
    protected $table;
    protected $pdo;

    public function __construct(){
        $this->pdo=Database::getPdo();
    }

    public function execReq($req,$param=array()){
        if(!empty($param)){
            $r=$this->pdo->prepare($req);
            return $r->execute($param);
        }else{
            return $this->pdo->query($req);
        }
    }

}