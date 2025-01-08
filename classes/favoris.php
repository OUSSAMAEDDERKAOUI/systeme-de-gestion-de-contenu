<?php 
require_once '../config/db.php';

class Favoris {

    private $id_article ;
    private $id_membre ;
private $database;

    public function __construct($id_article,$id_membre){
        $this->id_article=$id_article;
        $this->id_membre=$id_membre;
        $this->database=new Database;

    }

    public function getIdMembre(){
        return $this->id_membre;
    }
    public function getIdArticle(){
        return $this->id_article;
    }


    public function setIdMembre($id_membre){
         $this->id_membre=$id_membre;
    }
    public function setIdArticle($id_article){
        $this->id_article=$id_article;
   }



   public function addLikes($id_article,$id_membre){
    $stmt=$this->database->getConnection()->prepare('INSERT into favoris (`id_article`,`id_membre`)
VALUES (:id_article,:id_membre);');
$stmt->bindParam(':id_article',$id_article);
$stmt->bindParam(':id_membre',$id_membre);

try {
    $stmt->execute();
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
   }
}

?>