<?php
namespace tools;

use config\Config;

class Renderer{

    public static $content;

    public static function render(string $path,array $param=array()){
        ob_start();
        require_once(Config::$view.$path.".html.php");
        self::$content=ob_get_clean();

        return self::$content;
    }

    public static function sendHttpResponse($content,$code=200){
        http_response_code($code);
        echo $content;
    }
}
