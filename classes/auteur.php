<?php
require_once './user.php';

class Auteur extends Membre {

    public function addArticle($titre,$date, $contenu,$id_categorie,$id_auteur){
        $query ="INSERT INTO article (article.titre , article.date_publication,article.contenu,article.id_categorie,article.id_auteur)
                 VALUES (':titre',':date',':contenu',':id_categorie',':id_auteur') ";  
        $stmt = $this->database->getConnection()->prepare($query)   ;
        $stmt->bindValue(':titre',$titre ,PDO::PARAM_STR) ;        
        $stmt->bindValue( ':date' , $date,PDO::PARAM_STR) ; 
        $stmt->bindValue( ':contenu' , $contenu,PDO::PARAM_STR) ; 
        $stmt->bindValue( ':id_categorie' , $id_categorie,PDO::PARAM_INT) ; 
        $stmt->bindValue( ':id_auteur' , $id_auteur,PDO::PARAM_INT)  ;
        

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }



    public function updateArticle($id_article,$titre,$contenu,$date, $id_categorie){
        $query ="UPDATE `article`
                SET 
                    `titre`=':titre',
                    `contenu`=':contenu',
                     `id_categorie`=':id_categorie',
                WHERE id_article=:id_article";  
        $stmt = $this->database->getConnection()->prepare($query)   ;

        $stmt->bindValue( ':id_article' , $id_article,PDO::PARAM_INT)  ;
        $stmt->bindValue(':titre',$titre ,PDO::PARAM_STR) ;  
        $stmt->bindValue( ':contenu' , $contenu,PDO::PARAM_STR) ; 
        $stmt->bindValue( ':id_categorie' , $id_categorie,PDO::PARAM_INT) ; 

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    



    public function deleteArticle($id_article){
        $query ="UPDATE `article`
                SET `statut`='annuler'
                WHERE id_article=:id_article";  
        $stmt = $this->database->getConnection()->prepare($query)   ;
        
        $stmt->bindValue( ':id_article' , $id_article,PDO::PARAM_INT)  ;
      

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}

?>










<!-- MySQL utilise des codes comme :

1045 : "Access denied for user" (Accès refusé pour l'utilisateur - erreur d'authentification).
2002 : "Connection refused" (Connexion refusée - le serveur n'est pas accessible).
42S02 : "Table not found" (Table introuvable - la table que vous essayez d'interroger n'existe pas). -->