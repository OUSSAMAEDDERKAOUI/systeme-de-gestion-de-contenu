<?php
require_once '../config/db.php';

class Categorie {
   protected  $id_categorie;
   protected  $titre;
   protected  $dateCreation;
   protected  $status;
   protected $database;

   public function  __construct($titre,$dateCreation,$status){

    $this->titre=$titre;
    $this->dateCreation=$dateCreation;
    $this->status=$status;
    $this->database = new Database;

   }

   public function showCategory() {
    $stmt = $this->database->getConnection()->prepare('SELECT * FROM categorie');

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