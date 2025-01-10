<?php
require_once '../classes/user.php';


class Membre extends Users
{
    private $upload_img ;

public function __construct($upload_img){
    $this->upload_img=$upload_img;
   }


    public function signup($nom, $prenom, $email, $password, $role,$upload_img)
    {

        if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($role)|| empty($upload_img) ) {
            echo "Tous les champs sont obligatoires";
        }
        if (isset($upload_img) && $upload_img['error'] === UPLOAD_ERR_OK) {
            echo'text ok';
            $permited = array('jpg', 'png', 'jpeg', 'gif');
            $file_name = $upload_img['name'];
            $file_size = $upload_img['size'];
            $file_temp = $upload_img['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            
            if (in_array($file_ext, $permited) === false) {
                throw new Exception("Format d'image non autorisé. Autorisé : " . implode(', ', $permited));
            }
            
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $this->upload_img = "../upload/" . $unique_image;
            
            if (!move_uploaded_file($file_temp, $this->upload_img)) {
                throw new Exception("Échec du téléchargement de l'image.");
            }
        } else {
            throw new Exception("Aucune image à télécharger ou une erreur est survenue.");
        }


        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "User Already Exist";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO `users`( `nom`, `prenom`, `email`, `password`, `role`,`image`) 
                   VALUES (:nom,:prenom,:email,:password,:role,:upload_img)";

            $stmt = $this->database->getConnection()->prepare($query);

            $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);

            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->bindValue(':upload_img', $this->upload_img, PDO::PARAM_STR); 

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







    public function addComment($contenu,$id_article,$id_membre){
        $query="INSERT INTO commentaires (commentaires.contenu,commentaires.id_article,commentaires.id_membre)
                 VALUES  (:contenu,:id_article,:id_membre)  ";
                 echo'1';
        $stmt=$this->database->getConnection()->prepare($query);
        echo'2';

        $stmt->bindParam(':contenu',$contenu,PDO::PARAM_STR);
        $stmt->bindParam(':id_article',$id_article,PDO::PARAM_INT);
        $stmt->bindParam(':id_membre',$id_membre,PDO::PARAM_INT);
        echo'3';

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    


    


}
