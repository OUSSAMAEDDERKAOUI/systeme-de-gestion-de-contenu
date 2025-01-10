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
        users.nom,
        users.prenom, 
        users.email,
        users.status,
        COUNT(CASE WHEN article.statut = 'confirmer' THEN article.id_article END) AS nbr_article_confirmer,
        COUNT(CASE WHEN article.statut = 'annuler' THEN article.id_article END) AS nbr_article_annuler
    FROM 
        users 
    JOIN 
        article ON users.id_user = article.id_auteur
    GROUP BY 
        users.id_user, users.nom, users.prenom, users.email, users.status
    ");

    try {
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return $result;  
        } else {
            throw new Exception("Aucun auteur trouvé.");  
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

public function PendingArticle(){
    $stmt = $this->database->getConnection()->prepare("SELECT COUNT(article.id_article) AS nbr_article FROM `article` WHERE article.statut='en attente'");
    $stmt->execute(); 
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
return $result;
}


public function show_article() {
    $stmt = $this->database->getConnection()->prepare("SELECT article.titre AS titreArticle,categorie.titre AS titreCategorie,article.date_publication,article.id_article, users.nom,users.prenom,users.image FROM article JOIN users ON article.id_auteur=users.id_user JOIN categorie ON categorie.id_categorie=article.id_categorie
WHERE article.statut='en attente'");

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




public function accepteComment($id_comment){

    $stmt=$this->database->getConnection()->prepare("UPDATE commentaires
                                                      SET commentaires.statut='Accepté'
                                                      WHERE commentaires.id_comment= :id_comment ;");
    $stmt->bindParam(':id_comment',$id_comment,PDO::PARAM_STR);

     
     try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

}
public function refuseComment($id_comment){

$stmt=$this->database->getConnection()->prepare("UPDATE commentaires
                                                  SET commentaires.statut='Refusé'
                                                  WHERE commentaires.id_comment= :id_comment ;");
         $stmt->bindParam(':id_comment',$id_comment,PDO::PARAM_STR);

 try {
    $stmt->execute();
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

}

public function addTag($nom_tag,$id_admin){
    $stmt=$this->database->getConnection()->prepare('SELECT tags.nom_tag FROM tags WHERE tags.nom_tag =:nom_tag ');
    $stmt->bindParam(':nom_tag',$nom_tag,PDO::PARAM_STR);
    try {
        $stmt->execute();
        $result=$stmt->fetchAll();
        if(!empty($result)){
            echo'tag deja existe .';
        }
        else{
            $stmt=$this->database->getConnection()->prepare('INSERT INTO `tags`(`nom_tag`, `date_creation`, `id_admin`) VALUES (:nom_tag,CURRENT_DATE,:id_admin)');
            $stmt->bindParam(':nom_tag',$nom_tag,PDO::PARAM_STR);
            $stmt->bindParam(':id_admin',$id_admin,PDO::PARAM_INT);
        
           try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        }
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

   
}



public function showTag() {
    $stmt = $this->database->getConnection()->prepare("SELECT * FROM tags join users on tags.id_admin=users.id_user ");

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

public function deletetag($id_tag){
    $query ="DELETE FROM `tags`
            WHERE id_tag =:id_tag";  
    $stmt = $this->database->getConnection()->prepare($query)   ;
    echo'1';
    $stmt->bindValue( ':id_tag' , $id_tag ,PDO::PARAM_INT)  ;
    echo'2';

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}




}
    


// ajouter id_users au tableau categorie

?>
