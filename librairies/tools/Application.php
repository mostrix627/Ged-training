<?php
namespace tools;

use tools\RinoxException;

class Application{
    private static $controllerName;
    private static $task;

    public static function process(){
        self::$controllerName="PublicController";
        self::$task="accueil";

        if(isset($_GET['controller'])){
            self::$controllerName=$_GET["controller"];
        }

        if(isset($_GET['task'])){
            self::$task=$_GET["task"];
        }
        try{
            $task=self::$task;
            self::$controllerName="\Controllers\\".ucfirst(self::$controllerName);
            $controller=new self::$controllerName();
            if(!method_exists($controller,$task)){
                throw new RinoxException("erreur 404");
            }
            $controller->$task();
        }catch(RinoxException $e){
            $e->error404();
        }     
    }
}