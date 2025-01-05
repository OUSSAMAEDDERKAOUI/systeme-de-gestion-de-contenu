<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    
    if (isset($_POST['update'])) {
        $titre = $_POST['titre'];
        $id_category = $_POST['category']; 
        $content = $_POST['content'];
        $id_article = $_POST['id_article'];
        $uploadedFile = $_FILES['image'];

        if (!empty($titre) && !empty($id_category) && !empty($content)) {

            require_once '../classes/auteur.php';

            $article = new Auteur("", "", "", "", "", "", "");
            try {
                $article-> updateArticle($id_article, $titre, $content, $id_category, $uploadedFile);
                $_SESSION['success'] = "L'ajout d'article réussie !"; 
            } catch (Exception $e) {
                $_SESSION['error'] = "Erreur lors de l'ajout d'article : " . htmlspecialchars($e->getMessage());
            }
        } else {
            $_SESSION['error'] = "Veuillez remplir tous les champs du formulaire.";
        }
        header('location: ../views/auteur.php');
        exit; 
    }
}