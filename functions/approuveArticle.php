<?php

require_once '../classes/admin.php';
 $id_article=$_GET['id'];
echo $id_article;

$admin= new Admin("","","","","","","");

$admin->approuveArticle($id_article);
header('Location: ../views/admin.php')
?>