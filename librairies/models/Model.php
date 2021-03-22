<?php
namespace Models;

use \tools\Database;

abstract class Model{
    protected $table;
    protected $pdo;

    public function __construct(){
        $this->pdo=Database::getPdo();
    }
}