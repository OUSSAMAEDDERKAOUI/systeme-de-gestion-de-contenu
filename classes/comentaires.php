<?php
require_once '../config/db.php';

class Commentaire {
    private $id_comment;
    private $contenu;
    private $date_soumission;
    private $id_article;
    private $id_utilisateur;
    private $statut;
    private $database;

    public function __construct($id_comment, $contenu, $date_soumission, $id_article, $id_utilisateur) {
        $this->id_comment = $id_comment;
        $this->contenu = $contenu;
        $this->date_soumission = $date_soumission;
        $this->id_article = $id_article;
        $this->id_utilisateur = $id_utilisateur;
        $this->statut = 'En Attente';
        $this->database = new Database;
    }

    // GETTERS
    public function getIdComment() {
        return $this->id_comment;
    }
    
    public function getContenu() {
        return $this->contenu;
    }
    
    public function getDateSoumission() {
        return $this->date_soumission;
    }
    
    public function getIdArticle() {
        return $this->id_article;
    }
    
    public function getIdUtilisateur() {
        return $this->id_utilisateur;
    }
    
    public function getDatabase() {
        return $this->database;
    }
    
    public function getStatut() {
        return $this->statut;
    } 

    // SETTERS
    public function setIdComment($id_comment) {
        $this->id_comment = $id_comment;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu; 
    }
    
    public function setDateSoumission($date_soumission) {
        $this->date_soumission = $date_soumission;
    }
    
    public function setIdArticle($id_article) {
        $this->id_article = $id_article;
    }
    
    public function setIdUtilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }
    
    public function setStatut($statut) {
        $this->statut = $statut;
    } 

    public function setDatabase($database) {
        $this->database = $database;
    }
}
?>