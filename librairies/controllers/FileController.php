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
        $param['invalide']=$this->fileModel->getFileInvalide();
        $param['valide']=$this->fileModel->getFileValide();
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

    public function modifStatus(){
         foreach($_POST as $key=>$post){
             if($key!="substatus"){    
                $file=$this->fileModel->getFile($key);
                $statusAvant=$file["status"];
                $this->fileModel->updateStatus($key,$post);
                $file=$this->fileModel->getFile($key);
                if($statusAvant!=$file["status"]){
                    if($file['status']=="non valide"){
                        rename(Config::$doc_valid.$file['nom_fichier'],Config::$doc_not_valid.$file['nom_fichier']);
                    }else{
                        rename(Config::$doc_not_valid.$file['nom_fichier'],Config::$doc_valid.$file['nom_fichier']);
                    }
                }
            }
        }
        
    }


}