<?php
namespace tools;

use models\FileModel;
use \RuntimeException;
use \finfo;

class ToolsFiles
{

    private static $typeTab = array(
        'pdf' => 'application/pdf',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'doc' => 'application/msword',
    );
    private static $finfo;
    private static $nameFile;

    public static function getType()
    {
        return self::$typeTab;
    }

    public static function upload(array $file,$folder){
        foreach($file['doc'] as $key=>$fl){
            for($i=0;$i<count($fl);$i++){
                if($key=='name'){
                    self::$nameFile[$i]=basename($fl[$i]);
                }

                if($key=='error') {

                    if (
                        !isset($fl[$i]) ||
                        is_array($fl[$i])
                    ) {
                        throw new RuntimeException('Invalid parameters.');
                    }
                    switch ($fl[$i]) {
                        case UPLOAD_ERR_OK:
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            throw new RuntimeException('No file sent.');
                        case UPLOAD_ERR_INI_SIZE:
                        case UPLOAD_ERR_FORM_SIZE:
                            throw new RuntimeException('Exceeded filesize limit.');
                        default:
                            throw new RuntimeException('Unknown errors.');
                    }
                }


                if($key=='size'){
                    if ($fl[$i] > 1000000) {
                        throw new RuntimeException('Exceeded filesize limit.');
                    }
                }

                if($key=='tmp_name'){
                    $finfo=new \finfo(FILEINFO_MIME_TYPE);
                    if (false === $ext = array_search($finfo->file($fl[$i]),self::getType(), true)){
                        throw new RuntimeException('Invalid file format.');
                    }

                    move_uploaded_file($fl[$i],$folder."/".self::$nameFile[$i]);

                }

            }
        }

       return self::$nameFile;
    }

    public static function verifFile(array $file, FileModel $fileModel,array $session){
        self::$finfo= new finfo(FILEINFO_MIME_TYPE);
        for($i=0;$i<count($_FILES['doc']['name']);$i++){
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.

            if (!isset($file['doc']['error'][$i]) || is_array($file['doc']['error'][$i])) {
                throw new RuntimeException('Paramètre invalide.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($file['doc']['error'][$i]) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('Pas de fichier envoyé.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('fichier trop volumineux1.');
                default:
                    throw new RuntimeException('Erreur inconnu.');
            }

            // You should also check filesize here.
            /**  if ($_FILES['doc']['size'] > 1000000) {
             * throw new RuntimeException('fichier trop volumineux.');
             * }
             */
            // DO NOT TRUST $_FILES['doc']['mime'] VALUE !!
            // Check MIME Type by yourself.
            if (false === $ext = array_search(
                self::$finfo->file($file['doc']['tmp_name'][$i]), self::getType(), true)
            ){
                throw new RuntimeException('format invalide.');
            }
            // You should name it uniquely.
            $name = basename($file['doc']['name'][$i]);
            if (!move_uploaded_file($file['doc']['tmp_name'][$i], "../documents/" . $name)) {
                throw new RuntimeException('Import fichier échoué.');
            }

            $test = [$name, $session['id']];
            $fileModel->insert($test);
            Http::redirect("index.php?controller=FileController&task=ged");
        }
        try {
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($file['doc']['error']) ||
                is_array($file['doc']['error'])
            ) {
                throw new RuntimeException('Paramètre invalide.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($file['doc']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('Pas de fichier envoyé.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('fichier trop volumineux1.');
                default:
                    throw new RuntimeException('Erreur inconnu.');
            }

            // You should also check filesize here.
            /**  if ($_FILES['doc']['size'] > 1000000) {
             * throw new RuntimeException('fichier trop volumineux.');
             * }
             */
            // DO NOT TRUST $_FILES['doc']['mime'] VALUE !!
            // Check MIME Type by yourself.
            if (false === $ext = array_search(
                    self::$finfo->file($file['doc']['tmp_name']),
                    self::getType(),
                    true
                )) {
                throw new RuntimeException('format invalide.');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            $name = basename($file['doc']['name'][$i]);
            if (!move_uploaded_file($file['doc']['tmp_name'][$i], "../documents/" . $name)) {
                throw new RuntimeException('Import fichier échoué.');
            }

            $test = [$name, $session['id']];
            $fileModel->insert($test);
            Http::redirect("index.php?controller=FileController&task=ged");

        } catch (RuntimeException $e) {

            echo $e->getMessage();

        }
    }
}