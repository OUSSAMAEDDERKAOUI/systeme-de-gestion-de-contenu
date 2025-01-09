<?php


echo'hola';
require_once '../classes/admin.php';
$id_tag=$_GET['id'];
echo $id_tag;
$admin=new Admin("","","","","","");

$admin->deletetag($id_tag);
header('location: ../views/admin.php');

