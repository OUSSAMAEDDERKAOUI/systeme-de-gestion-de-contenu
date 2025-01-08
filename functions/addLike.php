<?php
require_once '../classes/favoris.php';
session_start();
$addLike=new Favoris("","");

$id_article=$_GET['id']   ;
$id_membre=$_SESSION['user_id']    ;


$addLike->addLikes($id_article,$id_membre);

header('Location: ../views/details.php?id='.$id_article);


?>