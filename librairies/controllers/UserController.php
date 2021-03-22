<?php
namespace Controllers;

use \Models\UserModel;
use \Models\FileModel;

use \tools\Renderer;
class UserController{
    public function profil(){
        $param=array('fichier'=>['id'=>1,'nom'=>"monfichier",'type'=>'doc']);
        //Renderer::sendHttpResponse(Renderer::render('profil',$param));
        echo "page profil à faire";
    }



}