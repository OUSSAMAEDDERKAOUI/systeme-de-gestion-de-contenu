<?php
require_once '../config/db.php';

class Article {
   protected  $id_article;
   protected  $titre;
   protected $contenu;
   protected  $date_publication;
   protected $id_categorie;
   protected $id_auteur;
   protected  $statut;
   protected $database;

   public function  __construct($titre,$contenu,$date_publication,$id_categorie,$id_auteur,$statut){

    $this->titre=$titre;
    $this->contenu=$contenu;
    $this->date_publication=$date_publication;
    $this->id_categorie=$id_categorie;
    $this->id_auteur=$id_auteur;
    $this->statut=$statut;
    $this->database = new Database;

   }





}


?>