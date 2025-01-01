<?php
  require_once './config/db.php' ;

class Users{ 
   protected $id_user ;
   protected $nom ;
   protected $prenom ;
   protected $email ;
   protected $password;
   protected $role;
   protected $database;


   public function __construct($id_user,$nom ,$prenom,$email,$password,$role){
    $this-> id_user =$id_user;
    $this->nom =$nom ;
    $this->prenom=$prenom;
    $this->email=$email;
    $this->password=$password ;
    $this->role=$role;
    $this->database= new database;
   }

   public function getId(){
    return $this->id_user ;
   }

   public function getNom(){
    return $this->nom;
   }
   public function getPrenom(){
    return $this->prenom;
   }
   public function getEmail(){
    return $this->email;
   }
   public function getPassword(){
    return $this->password ;
   }
   public function getRole(){
    return $this->role ;
   }


   public function setNom($nom){
    $this->nom=$nom;
   }
   public function setPrenom($prenom){
    $this->prenom=$prenom;
   }
   public function setEmail($email){
    $this->email=$email;
   }
   public function setPassword($password){
    $this->password=password_hash($password,PASSWORD_DEFAULT) ;
   }
  
   
    
}

?>