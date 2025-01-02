<?php
require_once '../classes/user.php';


class Membre extends Users
{

    public function signup($nom, $prenom, $email, $password, $role)
    {

        if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($role)) {
            echo "Tous les champs sont obligatoires";
        }

        
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            echo "User Already Exist";
        }
        else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `users`( `nom`, `prenom`, `email`, `password`, `role`) 
                   VALUES (:nom,:prenom,:email,:password,:role)";

        $stmt = $this->database->getConnection()->prepare($query);

        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);

        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        try {
            $stmt->execute();

        } catch (PDOException $e) {
            ;

            throw new Exception('Error occurred during sign-up: ' . $e->getMessage(), (int)$e->getCode());
        }
    }

        }

        
}
