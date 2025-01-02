<?php
require_once '../config/db.php';

class Categorie {
   protected  $id_categorie;
   protected  $titre;
   protected  $dateCreation;
   protected  $status;
   protected $database;

   public function  __construct($titre,$dateCreation,$status){

    $this->titre=$titre;
    $this->dateCreation=$dateCreation;
    $this->status=$status;
    $this->database = new Database;

   }

 



}


?>