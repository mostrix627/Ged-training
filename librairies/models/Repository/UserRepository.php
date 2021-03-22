<?php
namespace models\Repository;

use \models\Entity\User;
use models\Model;

class UserRepository extends Model{

    public function verif($user){
        $req="SELECT * FROM user WHERE email=? AND password=?";
        $req=$this->pdo->prepare($req);
        $req->execute($user);
        return $req->fetchAll();
    }
}