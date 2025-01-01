<?php
  require_once './config/db.php' ;

class users { 
   protected $id_user ;
   protected $nom ;
   protected $prenom ;
   protected $email ;
   protected $password;
   protected $database;


   public function __construct($id_user,$nom ,$prenom,$email,$password){
    $this-> id_user =$id_user;
    $this->nom =$nom ;
    $this->prenom=$prenom;
    $this->email=$email;
    $this->password=$password ;
    $this->database= new database;
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
    $this->password=$password ;
   }
   

    
}

?>