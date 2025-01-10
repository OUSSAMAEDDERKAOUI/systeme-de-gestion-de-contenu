<?php


echo'hola';
require_once '../classes/admin.php';
$id_category=$_GET['id'];
echo $id_category;
$admin=new Admin("","","","","","","");

$admin->deleteCategory($id_category);
header('location: ../views/admin.php');


?>