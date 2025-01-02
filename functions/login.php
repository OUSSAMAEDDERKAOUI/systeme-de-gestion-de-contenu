<?php

session_start();

require_once '../classes/admin.php' ;

if($_SERVER['REQUEST_METHOD']==='POST') {
    if(!empty(POST['email'])){
        $postEmail=$_POST['email'];
    }
    if(!empty(POST['password'])){
        $postPassword=$_POST['password'];
    }
}




?>