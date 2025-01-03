<?php 
 require_once '../classes/membre.php';
 $membre = new Membre("", "", "", "", "", "");



 $id_article=$_GET['id'];
 echo $id_article;

 $membre->showDetails($id_article);

// header('location: ../views/details.php');

















?>