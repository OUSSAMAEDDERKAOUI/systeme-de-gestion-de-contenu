<?php
require_once '../config/db.php';

class Article {
   protected  $id_article;
   protected  $titre;
   protected $contenu;
   protected  $date_publication;
   protected $id_categorie;
   protected $id_auteur;
   protected  $statut;
   protected $upload_img;
   protected $database;

   public function  __construct($titre,$contenu,$date_publication,$id_categorie,$id_auteur,$statut,$upload_img){

    $this->titre=$titre;
    $this->contenu=$contenu;
    $this->date_publication=$date_publication;
    $this->id_categorie=$id_categorie;
    $this->id_auteur=$id_auteur;
    $this->statut=$statut;
    $this->upload_img=$upload_img;
    $this->database = new Database;

   }

   public function addArticle($titre, $contenu, $id_categorie, $id_auteur, $upload_img) {
    if (isset($upload_img) && $upload_img['error'] === UPLOAD_ERR_OK) {
        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $upload_img['name'];
        $file_size = $upload_img['size'];
        $file_temp = $upload_img['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        
        if (in_array($file_ext, $permited) === false) {
            throw new Exception("Format d'image non autorisé. Autorisé : " . implode(', ', $permited));
        }
        
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $this->upload_img = "../upload/" . $unique_image;
        
        // Tentez de déplacer le fichier
        if (!move_uploaded_file($file_temp, $this->upload_img)) {
            throw new Exception("Échec du téléchargement de l'image.");
        }
    } else {
        throw new Exception("Aucune image à télécharger ou une erreur est survenue.");
    }

    // Préparer la requête d'insertion
    $query = "INSERT INTO article (titre, date_publication, contenu, id_categorie, id_auteur, image)
              VALUES (:titre, CURRENT_DATE, :contenu, :id_categorie, :id_auteur, :upload_img)";

    $stmt = $this->database->getConnection()->prepare($query);

    // Lier les paramètres
    $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindValue(':contenu', $contenu, PDO::PARAM_STR);
    $stmt->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
    $stmt->bindValue(':id_auteur', $id_auteur, PDO::PARAM_INT);
    $stmt->bindValue(':upload_img', $this->upload_img, PDO::PARAM_STR); // Utilisez ici le chemin de l'image

    // Essayer d'exécuter la requête
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}

}


?>