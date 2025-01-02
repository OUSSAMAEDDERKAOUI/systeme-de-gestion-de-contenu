<?php

include_once '../classes/user.php' ;

class Admin extends Users {

public function addCategory($titre,$id_admin){
            echo'testvalid1';

    $query="INSERT INTO `categorie`(`titre`,`dateCreation`,`id_admin`)
            VALUES (:titre,CURRENT_DATE,:id_admin)";

    $stmt=$this->database->getConnection()->prepare($query);
    echo'testvalid2';

    $stmt->bindValue(':titre', $titre , PDO::PARAM_STR);
    $stmt->bindValue(':id_admin', $id_admin , PDO::PARAM_STR);
    echo'testvalid3';

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
   
}

public function showCategory() {
    $stmt = $this->database->getConnection()->prepare("SELECT * FROM categorie join users on categorie.id_admin=users.id_user WHERE categorie.status='confirmee' ");

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



public function updateCategory($titre,$id_categorie,$status){
    $query ="UPDATE `categorie`
             SET `titre`=:titre,`status`=:status 
             WHERE `id_categorie`=:id_categorie";  
    $stmt = $this->database->getConnection()->prepare($query)   ;

    $stmt->bindValue(':titre',$titre ,PDO::PARAM_STR) ;  
    $stmt->bindValue( ':status' , $status,PDO::PARAM_STR) ; 
    $stmt->bindValue( ':id_categorie' , $id_categorie,PDO::PARAM_INT) ; 

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}


public function deleteCategory($id_categorie){
    $query ="UPDATE `categorie`
            SET `status`= 'annulee'
            WHERE id_categorie =:id_category";  
    $stmt = $this->database->getConnection()->prepare($query)   ;
    echo'1';
    $stmt->bindValue( ':id_category' , $id_categorie ,PDO::PARAM_INT)  ;
    echo'2';

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}


public function showAuteur(){
    $stmt = $this->database->getConnection()->prepare("SELECT 
    users.nom,users.prenom, users.email,
    COUNT(CASE WHEN article.statut = 'confirmer' THEN article.id_article END) AS nbr_article_confirmer,
    COUNT(CASE WHEN article.statut = 'annuler' THEN article.id_article END) AS nbr_article_annuler
FROM 
    users 
 JOIN 
    article ON users.id_user = article.id_auteur
GROUP BY 
    users.id_user, users.nom
");

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


public function allArticle(){
        $stmt = $this->database->getConnection()->prepare("SELECT COUNT(article.id_article) AS nbr_article FROM `article` WHERE 1");
        $stmt->execute(); 
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}
public function confirmedArticle(){
    $stmt = $this->database->getConnection()->prepare("SELECT COUNT(article.id_article) AS nbr_article FROM `article` WHERE article.statut='confirmer'");
    $stmt->execute(); 
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}
public function rejectedArticle(){
    $stmt = $this->database->getConnection()->prepare("SELECT COUNT(article.id_article) AS nbr_article FROM `article` WHERE article.statut='annuler'");
    $stmt->execute(); 
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}


public function show_article() {
    $stmt = $this->database->getConnection()->prepare("SELECT article.titre AS titreArticle,categorie.titre AS titreCategorie,article.date_publication,article.id_article, users.nom,users.prenom FROM article JOIN users ON article.id_auteur=users.id_user JOIN categorie ON categorie.id_categorie=article.id_categorie
WHERE article.statut='annuler'");

    try {
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return $result;  
        } else {
            throw new Exception("Aucun article trouvé.");  
        }
        
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
        return null; 
    } catch (Exception $e) {

        echo "Erreur : " . $e->getMessage();
        return null;  
    }
}



public function approuveArticle($id_article){
    $query ="UPDATE article
SET article.statut='confirmer'
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
    



// ajouter id_users au tableau categorie

?>
