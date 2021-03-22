<?php
namespace models\Entity;

class User{

    private $id;
    private $name;
    private $email;
    private $role;
    private $password;

    public function __construct($id=null,$name=null,$email=null,$role=null,$password=null){
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setRole($role);
        $this->setPassword($password);
    }

    public function initialize($array){
        $this->setId($array['id']);
        $this->setName($array['nom']);
        $this->setEmail($array['email']);
        $this->setRole($array['role']);
        $this->setPassword($array['password']);
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getRole(){
        return $this->role;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setName($name){
        $this->name=$name;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function setRole($role){
        $this->role=$role;
    }

    public function setPassword($password){
        $this->password=$password;
    }


}