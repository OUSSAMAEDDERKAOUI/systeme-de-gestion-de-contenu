<?php
include '../classes/membre.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $role = htmlspecialchars($_POST['role']);
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
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

