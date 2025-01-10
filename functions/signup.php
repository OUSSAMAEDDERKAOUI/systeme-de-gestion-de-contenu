<?php
// include '../classes/membre.php';
// include '../classes/mailing.php';
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['signup'])) {
//         $nom = htmlspecialchars($_POST['nom']);
//         $prenom = htmlspecialchars($_POST['prenom']);
//         $role = htmlspecialchars($_POST['role']);
//         $email = htmlspecialchars($_POST['email']);
//         $password = $_POST['password'];
//         $membre = new Membre("", "", "", "", "", "");
//         $subject='hola';
//         $body='hola amigo';

// try {
//                 $membre->signup($nom, $prenom, $email, $password, $role);
//                 $mailing =new Mailing("","","","");

//                 $mailing->sendMail($nom, $email, $subject, $body);
//                 echo "Inscription réussie !"; 
//             } catch (Exception $e) {
//                 echo "Erreur lors de l'inscription : " . htmlspecialchars($e->getMessage());
//             }
//         } else {
//             echo "Veuillez remplir tous les champs du formulaire.";
//         }  
//       }

//     //   header('Location: ../views/login.php')



      ?>



<?php

require_once '../classes/membre.php';
require_once '../classes/mailing.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $role = htmlspecialchars($_POST['role']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $upload_img = $_FILES['image'];

        $membre = new Membre("", "", "", "", "", "");
        $subject = 'Bienvenue sur MelodyHub';
        $body = "Bonjour $prenom $nom,<br><br>Merci de vous être inscrit sur MelodyHub. Nous sommes ravis de vous accueillir !";

        try {
            $membre->signup($nom, $prenom, $email, $password, $role, $upload_img);
            $mailing = new Mailing("$prenom $nom", $email, $subject, $body);

            if ($mailing->sendMail()) {
                echo "Inscription réussie et email envoyé !";
            } else {
                echo "Inscription réussie, mais l'envoi de l'email a échoué.";
            }
        } catch (Exception $e) {
            echo "Erreur lors de l'inscription : " . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}
    //   header('Location: ../views/login.php')



?>

