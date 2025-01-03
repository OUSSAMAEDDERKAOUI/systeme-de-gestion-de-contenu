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

        if ($stmt->rowCount() > 0) {
            echo "User Already Exist";
        } else {
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
            } catch (PDOException $e) {;

                throw new Exception('Error occurred during sign-up: ' . $e->getMessage(), (int)$e->getCode());
            }
        }
    }

    public function showapprovedArticle()
    {


        $stmt = $this->database->getConnection()->prepare(
            "SELECT  article.titre AS articleTitre, article.contenu, article.date_publication, article.statut, article.image ,categorie.titre AS categorieTitre ,article.id_article,users.nom,users.prenom
                                                          FROM article 
                                                          JOIN users ON article.id_auteur=users.id_user
                                                          JOIN categorie on article.id_categorie=categorie.id_categorie 
                                                          WHERE article.statut='confirmer'  ;"
        );

        try {
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
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

    public function showArticle($id_category)
    {


        $stmt = $this->database->getConnection()->prepare(
            "SELECT  article.titre AS articleTitre, article.contenu, article.date_publication, article.statut, article.image ,categorie.titre AS categorieTitre ,article.id_article,users.nom,users.prenom
                                                          FROM article 
                                                          JOIN users ON article.id_auteur=users.id_user
                                                          JOIN categorie on article.id_categorie=categorie.id_categorie 
                                                          WHERE article.statut='confirmer' AND article.id_categorie=:id_category ;"
        );
        $stmt->bindParam(':id_category',$id_category,PDO::PARAM_INT);

        try {
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
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






    public function showDetails($id_article)
    {


        $stmt = $this->database->getConnection()->prepare(
            "SELECT  article.titre AS articleTitre, article.contenu, article.date_publication, article.statut, article.image ,categorie.titre AS categorieTitre ,article.id_article,users.nom,users.prenom
                                                          FROM article 
                                                          JOIN users ON article.id_auteur=users.id_user
                                                          JOIN categorie on article.id_categorie=categorie.id_categorie 
                                                          WHERE article.statut='confirmer' AND article.id_article = :id_article ;"
        );
        $stmt->bindParam(':id_article',$id_article,PDO::PARAM_INT);

        try {
            $stmt->execute();


            if ($stmt) {
                return $stmt;
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
