<?php


require_once '../classes/auteur.php';
$id_article=$_GET['id'];
echo $id_article;
$auteur=new auteur("","","","","","");

$auteur->deleteArticle($id_article);
header('location: ../views/auteur.php');


?>