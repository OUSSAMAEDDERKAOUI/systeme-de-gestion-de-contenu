<?php

session_start();

require_once '../classes/user.php' ;
require_once '../config/db.php';
require_once '../functions/checkRole.php';

if(!isAuth('admin')&& !isAuth('membre')&&!isAuth('auteur')){
    header('Location: ../views/login.php');
}else {
    header('Location: ../views/'.$_SESSION['user_role'].'.php');

}

if($_SERVER['REQUEST_METHOD']==='POST'){
    echo'1';
    if(isset($_POST['login'])){
        echo'2';
       
        $postEmail = trim(string: $_POST['email']);
        $postPassword = $_POST['password'];

        if (empty($postEmail) || empty($postPassword)) {
            echo'3';

            echo "Veuillez remplir tous les champs.";
        }else {
            echo'4';

            $user = new Users("","","","","","","");

            $loggedInUser = $user->login( $postEmail, $postPassword);

            if ($loggedInUser) {
                
                echo'5';

                $_SESSION['user_id'] = $loggedInUser->getId();
                $_SESSION['user_prenom'] = $loggedInUser->getPrenom();
                $_SESSION['user_nom'] = $loggedInUser->getNom();
                $_SESSION['user_email'] = $loggedInUser->getEmail();
                $_SESSION['user_role'] = $loggedInUser->getRole();
                $_SESSION['user_image'] = $loggedInUser->getimage();




echo  $_SESSION['user_role'];



                // header('Location: ../views/'.$_SESSION['user_role'].'.php');
                // if($_SESSION['user_role'] ==='admin'){
                //     header("Location: ../views/admin.php");
                // }else if($_SESSION['user_role'] ==='membre'){
                //     header("Location: ../views/membre.php");
                // } else if($_SESSION['user_role'] ==='auteur'){
                //     header("Location: ../views/auteur.php");
                    
                // }
                header('Location: '.$_SERVER['PHP_SELF']);


                exit;
            } else {
                echo'6--------------------------';

                echo "Identifiants incorrects.";
            }
        }
        
    }
}



?>