<?php
namespace tools;

use PDO;
use config\ConfigDb;
class Database extends ConfigDb{
    public static function getPdo(){
        $pdo=new PDO(self::$sgbd.':host='.self::$adresse.';dbname='.self::$base, self::$user, self::$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}