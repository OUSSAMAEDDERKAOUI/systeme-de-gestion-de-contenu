<?php
require_once '../classes/membre.php';
session_start();

if (isset($_GET['id']) && isset($_POST['contenu']) && isset($_SESSION['user_id'])) {
    $id_article = intval($_GET['id']); 
    $contenu = htmlspecialchars(trim($_POST['contenu'])); 
    $id_membre = $_SESSION['user_id'];

    $comment = new Membre("", "", "", "", "", "");
    
    $comment->addComment($contenu, $id_article, $id_membre);
    
    header("Location: ../views/details.php?id=" . $id_article);
    exit(); 
} else {
    echo 'Données manquantes. Veuillez réessayer.';
}
?>