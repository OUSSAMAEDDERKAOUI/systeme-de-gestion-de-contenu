<?php

include_once './user.php' ;

class Admin extends Users {

public function addCategory($titre,$id_auteur){
    $query="INSERT INTO `categorie`(`titre`,`dateCreation`,`id_auteur`)
            VALUES (`:titre`,CURRENT_DATE,`:id_auteur`)";

    $stmt=$this->database->getConnection()->prepare($query);

    $stmt->bindValue(':titre', $titre , PDO::PARAM_STR);
    $stmt->bindValue(':id_auteur ', $id_auteur , PDO::PARAM_STR);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
   
}


public function updateCategory($titre,$id_categorie,$status){
    $query ="UPDATE `categorie`
             SET `titre`=':titre',`status`=':status' 
             WHERE `id_categorie`=':id_categorie'";  
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


public function deleteCategory($id_categorie,$status){
    $query ="UPDATE `categorie`
            SET `statut`='annulee'
            WHERE id_category=:id_category";  
    $stmt = $this->database->getConnection()->prepare($query)   ;
    
    $stmt->bindValue( ':status' , $status,PDO::PARAM_STR)  ;
    $stmt->bindValue( ':id_category' , $id_categorie ,PDO::PARAM_INT)  ;

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}



}
    



// ajouter id_users au tableau categorie

?>
