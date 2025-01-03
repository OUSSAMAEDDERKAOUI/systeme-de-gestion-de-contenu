<?php
session_start();
require_once '../classes/auteur.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert'])) {
        $titre = $_POST['titre'];
        $id_category = $_POST['category'];
        $content = $_POST['content'];
        $id_auteur = $_SESSION['user_id'];
        if (!empty($titre) || !empty($category) || !empty($content)) {
            $insertMethode = new Auteur("", "", "", "", "", "");
            try {
                $insertMethode->addArticle($titre, $content, $id_category, $id_auteur);
                echo "L'ajout d'article réussie !";
            } catch (Exception $e) {
                echo "Erreur lors de L'ajout d'article : " . htmlspecialchars($e->getMessage());
            }
        } else {
            echo "Veuillez remplir tous les champs du formulaire.";
        }
        header('location: ../views/auteur.php');
    }
}
