<?php
require_once '../classes/admin.php';
$id_comment=$_GET['id'];
echo $id_comment;

$removeComment= new Admin("","","","","","");

$removeComment->refuseComment($id_comment);
header('Location: ../views/admin.php')




?>