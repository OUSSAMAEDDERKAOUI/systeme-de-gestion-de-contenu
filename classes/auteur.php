<?php
require_once __DIR__.'./membre.php';

class Auteur extends Membre {

    public function addArticle($titre, $contenu,$id_categorie,$id_auteur){
        $query ="INSERT INTO article (article.titre , article.date_publication,article.contenu,article.id_categorie,article.id_auteur)
                 VALUES (:titre,CURRENT_DATE,:contenu,:id_categorie,:id_auteur) ";  
        $stmt = $this->database->getConnection()->prepare($query)   ;
        $stmt->bindValue(':titre',$titre ,PDO::PARAM_STR) ;        
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
                    `titre`=:titre,
                    `contenu`=:contenu,
                     `id_categorie`=:id_categorie,
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
        $query ="DELETE FROM `article`
                WHERE id_article=:id_article";  
        $stmt = $this->database->getConnection()->prepare($query)   ;
        $stmt->bindValue( ':id_article' , $id_article,PDO::PARAM_INT)  ;
      

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }




    public function allArticle($id_auteur){

        
        $stmt = $this->database->getConnection()->prepare("SELECT COUNT(article.id_article)  AS nbr_article
                                                        FROM article JOIN users on  article.id_auteur=users.id_user
                                                        WHERE article.id_auteur=:id_auteur");
          $stmt->bindParam(':id_auteur',$id_auteur,PDO::PARAM_INT);
        $stmt->execute(); 
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}



public function confirmedArticle($id_auteur){
    $stmt = $this->database->getConnection()->prepare("SELECT COUNT(article.id_article)  AS nbr_article
                                                        FROM article JOIN users on  article.id_auteur=users.id_user
                                                        WHERE article.id_auteur=:id_auteur AND  article.statut='confirmer'");
    $stmt->bindParam(':id_auteur',$id_auteur,PDO::PARAM_INT);

    $stmt->execute(); 
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}


public function rejectedArticle($id_auteur){
    $stmt = $this->database->getConnection()->prepare("SELECT COUNT(article.id_article)  AS nbr_article
                                                        FROM article JOIN users on  article.id_auteur=users.id_user
                                                        WHERE article.id_auteur=:id_auteur AND article.statut='annuler'");
    $stmt->bindParam(':id_auteur',$id_auteur,PDO::PARAM_INT);

    $stmt->execute(); 
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}


public function showCategory() {
    $stmt = $this->database->getConnection()->prepare("SELECT DISTINCT categorie.titre ,categorie.id_categorie FROM categorie  WHERE categorie.status='confirmee' ");

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



public function showArticle($id_user) {

    
    $stmt = $this->database->getConnection()->prepare("SELECT  article.titre AS articleTitre, article.contenu, article.date_publication, article.statut ,categorie.titre AS categorieTitre ,article.id_article,users.nom,users.prenom
                                                      FROM article 
                                                      JOIN users ON article.id_auteur=users.id_user
                                                      JOIN categorie on article.id_categorie=categorie.id_categorie 
                                                      WHERE users.id_user=:id_user ;"
                                                      );
                                                      $stmt->bindParam(':id_user',$id_user,PDO::PARAM_INT);

    try {
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return $result;  
        } else {
           echo "Aucun article trouvé.";  
        }
        
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
        return null; 
    } catch (Exception $e) {

        echo "Erreur : " . $e->getMessage();
        return null;  
    }
}


public function showapprovedArt($id_user) {

    
    $stmt = $this->database->getConnection()->prepare("SELECT  article.titre AS articleTitre, article.contenu, article.date_publication, article.statut ,categorie.titre AS categorieTitre ,article.id_article,users.nom,users.prenom
                                                      FROM article 
                                                      JOIN users ON article.id_auteur=users.id_user
                                                      JOIN categorie on article.id_categorie=categorie.id_categorie 
                                                      WHERE article.statut='confirmer' AND users.id_user=:id_user ;"
                                                      );
                                                      $stmt->bindParam(':id_user',$id_user,PDO::PARAM_INT);

    try {
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result)>0) {
            return $result;  
        } else {
           echo "Aucun article trouvé.";  
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










<!-- MySQL utilise des codes comme :

1045 : "Access denied for user" (Accès refusé pour l'utilisateur - erreur d'authentification).
2002 : "Connection refused" (Connexion refusée - le serveur n'est pas accessible).
42S02 : "Table not found" (Table introuvable - la table que vous essayez d'interroger n'existe pas). -->