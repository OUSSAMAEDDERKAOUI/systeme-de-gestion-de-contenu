<?php
require_once '../config/db.php';

class TagArticle {
    private $database;
    private  $id_article;
    private  $id_tag;



    public function __construct($id_article,$id_tag) {
        $this->id_article=$id_article;
        $this->id_tag=$id_tag;
        $this->database = new Database;
    }

    


    public function getTagsByArticle($id_article) {
        $query = "
            SELECT tags.id_tag, tags.nom_tag
            FROM tags
            JOIN article_tag ON tags.id_tag = article_tag.id_tag
            WHERE article_tag.id_article = :article_id
        ";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->execute(['article_id' => $id_article]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les articles associés à un tag
    public function getArticlesByTag($tag_id) {
        $query = "
            SELECT articles.id, articles.title 
            FROM articles
            JOIN article_tags ON articles.id = article_tags.article_id
            WHERE article_tags.tag_id = :tag_id
        ";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->execute(['tag_id' => $tag_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    
   
}
?>
