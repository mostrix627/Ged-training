<?php
namespace tools;

use \models\Entity\User;

class Http{
    public static function redirect($lien){
        header('Location: '.$lien);
        exit;
    }

    public static function createSession(User $user){
        $_SESSION['id']=$user->getId();
        $_SESSION['role']=$user->getRole();
    }

    public static function destructSession(){
        session_destroy();
    }
}

