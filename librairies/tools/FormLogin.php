<?php
namespace tools;

use Models\UserModel;
use Models\Repository\UserRepository;

class FormLogin{
    private $option;
    private $status;

    public function __construct(){
        $this->status=false;
        $this->option['message']='';
    }

    public function validateLogin(array $post,UserRepository $userModel){

            if ($post['connexion']=="connexion"){
                if (!empty($post['email']) && !empty($post['password'])) {
                    $mail = htmlspecialchars($post['email']);
                    $pass = htmlspecialchars($post['password']);

                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        if ($user = $userModel->verif([$mail, $pass])) {
                            $this->status=$user;
                        } else {
                            $this->setMessageError("mail ou mot de passe incorrect");
                        }

                    } else {
                        $this->setMessageError("veuillez saisir un adresse mail valide");

                    }
                } else {
                    $this->setMessageError("pas bien remplie");
                }

            } else {
                $this->setMessageError("veuillez inscrire vos identifiants");
            }

            return $this->status;

    }

    private function setOption($key,$value){
        $this->option=[$key=>$value];
    }

    private function setMessageError($value){
        $this->setOption('message',$value);
    }

    public function getOption(){
        return $this->option;
    }
}