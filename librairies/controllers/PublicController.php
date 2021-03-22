<?php
namespace Controllers;

use models\Entity\User;
use \tools\Renderer;
use \tools\Http;
use \tools\FormLogin;
use \Models\Repository\UserRepository;

class PublicController{

    private $userModel;
    private $formLogin;
    private $userCon;

    public function __construct(){
        $this->formLogin=new FormLogin();
        $this->userModel=new UserRepository();
        $this->userCon=new User();
    }

    public function accueil($option=array()){
        if(!isset($_SESSION['id'])){
            $message_erreur_form='';
            if(isset($option['message'])){
                $message_erreur_form=$option['message'];
            }
            
            $param=array('message_erreur_form'=>$message_erreur_form);
            Renderer::sendHttpResponse(Renderer::render('accueil',$param));
        }else{
            Http::redirect("index.php?controller=UserController&task=profil");
        }

    }


    public function authentification(){
        if($user=$this->formLogin->validateLogin($_POST,$this->userModel)){
            $this->userCon->initialize($user[0]);
            Http::createSession($this->userCon);
            Http::redirect("index.php?controller=FileController&task=ged");
        }
        $this->accueil($this->formLogin->getOption());
    }

    public function deconnexion(){
        Http::destructSession();
        Http::redirect("index.php?controller=publicController&task=accueil");
    }
    
}