<?php
echo 'hola';
session_start();
require_once '../classes/admin.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    // echo'valid1';

    if(isset($_POST['addCategory'])){
        $titre=htmlspecialchars($_POST['category']); 
        $idAuteur=htmlspecialchars($_SESSION['user_id']);

        if(empty($titre)||empty($idAuteur)){
            echo'il faux remplit toutes les champs .';
            // echo'valid2';

        } else {
            // echo'valid3';

            $admin=new Admin("","","","","","","");
            // echo'valid4';

            $admin->addCategory($titre,$idAuteur);


            // echo'valid5';

           header('Location: ../views/admin.php');
        }
    }
}












?>