<?php
require_once '../classes/admin.php';
$id_comment=$_GET['id'];
echo $id_comment;

$accepteComment= new Admin("","","","","","","");

$accepteComment->accepteComment($id_comment);
header('Location: ../views/admin.php')




?>