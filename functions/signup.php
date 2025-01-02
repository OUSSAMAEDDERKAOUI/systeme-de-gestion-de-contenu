<?php
include '../classes/membre.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        $nom = htmlspecialchars(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING)).
        $prenom = htmlspecialchars(filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING));
        $role = htmlspecialchars(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING));
        $email = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
        $membre = new Membre("", "", "", "", "", "");

try {
                $membre->signup($nom, $prenom, $email, $password, $role);
                echo "Inscription réussie !"; 
            } catch (Exception $e) {
                echo "Erreur lors de l'inscription : " . htmlspecialchars($e->getMessage());
            }
        } else {
            echo "Veuillez remplir tous les champs du formulaire.";
        }  
      }

      header('Location: ../views/login.php')



      ?>

