<?php
namespace tools;

use config\ConfigDb;
class Database extends ConfigDb{
    public static function getPdo(){
        $pdo=new \PDO(self::$sgbd.':host='.self::$adresse.';dbname='.self::$base, self::$user, self::$pass);
        return $pdo;
    }
}