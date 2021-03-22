<?php
namespace tools;

use tools\RinoxException;

class Autoload{

    public static function load(){
        spl_autoload_register(function($className){
            $className=str_replace("\\","/",$className);
            if(!file_exists("librairies/".$className.".php")){
                throw new RinoxException("erreur 404");
            }
            require_once("librairies/".$className.".php");
        });
    }
}
