CREATE DATABASE gestion_contenu ;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'membre', 'auteur') NOT NULL
);
CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    dateCreation DATE NOT NULL,
    status ENUM('confirmee', 'annulee') NOT NULL
);
CREATE TABLE article (
    id_article INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_publication DATE NOT NULL,
    id_categorie INT,
    id_auteur INT,
    statut  Enum('confirmer','annuler') ,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_auteur) REFERENCES users(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);




INSERT INTO users (nom, prenom, email, password, role) VALUES
('edderkaoui', 'oussama', 'oussama@gmail.com', 'oussama18', 'admin'),
('Zouari', 'Fatima', 'fatima@gmail.com', 'oussama18', 'auteur'),
('Belkassem', 'Mohamed', 'mohamed@gmail.com', 'oussama18', 'membre'),
('Bennani', 'Sarah', 'sarah@gmail.com', 'oussama18', 'membre'),
('Khalil', 'Youssef', 'youssef@gmail.com', 'oussama18', 'auteur');
INSERT INTO categorie (titre, dateCreation, status) VALUES
('Cuisine Marocaine', '2023-01-10', 'confirmee'),
('Voyages au Maroc', '2023-02-15', 'confirmee'),
('Technologie et Innovation', '2023-03-01', 'annulee'),
('Culture et Traditions', '2023-03-25', 'confirmee'),
('Économie et Marché', '2023-04-05', 'confirmee');
INSERT INTO article (titre, contenu, date_publication, id_categorie, id_auteur, statut) VALUES
('10 Recettes de Couscous Traditionnelles', 'Découvrez les différentes recettes de couscous marocain...', '2023-05-01', 1, 2, 'annuler'),
('Exploration des Oasis du Sud', 'Un voyage à travers les magnifiques oasis marocaines...', '2023-05-10', 2, 3, 'annuler'),
('L’impact de la Technologie sur l’éducation', 'La technologie transforme le paysage éducatif au Maroc...', '2023-05-15', 3, 5, 'annuler'),
('Les Festivals de Musique au Maroc', 'Revivez les festivals les plus populaires du pays...', '2023-05-20', 4, 2, 'confirmer'),
('Analyse du Marché Immobilier Marocain', 'Étude sur les tendances du marché immobilier...', '2023-05-25', 5, 4, 'confirmer');