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
   protected $database;

   public function  __construct($titre,$contenu,$date_publication,$id_categorie,$id_auteur,$statut){

    $this->titre=$titre;
    $this->contenu=$contenu;
    $this->date_publication=$date_publication;
    $this->id_categorie=$id_categorie;
    $this->id_auteur=$id_auteur;
    $this->statut=$statut;
    $this->database = new Database;

   }

   public function showArticle() {
    $stmt = $this->database->getConnection()->prepare("SELECT  article.titre, article.contenu, article.date_publication, article.statut ,categorie.titre,users.nom,users.prenom
                                                      FROM article 
                                                      JOIN users ON article.id_auteur=users.id_user
                                                      JOIN categorie on article.id_categorie=categorie.id_categorie 
                                                      WHERE article.statut='confirmer';"
                                                      );

    try {
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return $result;  
        } else {
            throw new Exception("Aucun categorie trouvé.");  
        }
        
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
        return null; 
    } catch (Exception $e) {

        echo "Erreur : " . $e->getMessage();
        return null;  
    }
}



}


?>