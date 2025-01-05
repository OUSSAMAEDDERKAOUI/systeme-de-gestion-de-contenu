<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert'])) {
        $titre = $_POST['titre'];
        $id_category = $_POST['category']; 
        $content = $_POST['content'];
        $id_auteur = $_SESSION['user_id'];
        $upload_img = $_FILES['image'];

        if (!empty($titre) && !empty($id_category) && !empty($content)) {

            require_once '../classes/article.php';

            $article = new Article("", "", "", "", "", "", "");
            try {
                $article->addArticle($titre, $content, $id_category, $id_auteur, $upload_img);
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