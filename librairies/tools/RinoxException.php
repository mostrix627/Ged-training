<?php
namespace tools;

use \Exception;
use \tools\Renderer;

class RinoxException extends Exception{

    public function __construct($message, $code = 0)
    {
      parent::__construct($message, $code);
    }
    
    public function error404(){
        Renderer::sendHttpResponse(Renderer::render('error',[$this->getMessage()]),404);
    }
}
