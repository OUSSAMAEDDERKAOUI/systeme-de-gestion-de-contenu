<?php
require_once './user.php';


class Membre extends Users
{

    public function signup($nom, $prenom, $email, $password, $role)
    {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `users`( `nom`, `prenom`, `email`, `password`, `role`) 
                   VALUES (':nom',':prenom',':email',':password','role')";

        $stmt = $this->database->getConnection()->prepare($query);

        $stmt->bindValues(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValues(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindValues(':email', $email, PDO::PARAM_STR);
        $stmt->bindValues(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValues(':role', $role, PDO::PARAM_STR);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error occurred during sign-up: ' . $e->getMessage(), (int)$e->getCode());
        }
    }
}
