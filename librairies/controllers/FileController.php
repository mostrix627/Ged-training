<?php
namespace Controllers;

use tools\Http;
use \tools\ToolsFiles;
use \tools\Renderer;
use \Models\Repository\FileRepository;
use \config\Config;

class FileController{

    protected $fileModel;

    public function __construct(){
        $this->fileModel=new FileRepository();
    }

    public function insert(){
        $fx=ToolsFiles::upload($_FILES,Config::$doc_not_valid);
        for($int=0;$int<count($fx);$int++){
            $this->fileModel->insert([$fx[$int], $_SESSION['id']]);
        }
        Http::redirect("index.php?controller=FileController&task=ged");
    }

    public function ged(){
        $param=$this->fileModel->getAll();
        if(isset($_SESSION['id'])){
            switch($_SESSION['role']){
                case 'utilisateur':
                    Renderer::sendHttpResponse(Renderer::render('gedUser',$param));
                break;
                case 'responsable':
                    Renderer::sendHttpResponse(Renderer::render('gedResponsable',$param));
            }

        }

    }


}