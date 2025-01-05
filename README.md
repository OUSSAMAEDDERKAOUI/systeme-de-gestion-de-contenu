# README

## Projet: Cultures Partagées - Système de Gestion de Contenu

### Description
Ce projet vise à concevoir et à développer un système de gestion de contenu performant pour la plateforme "Cultures Partagées". L'application web permettra aux utilisateurs de créer, organiser et découvrir des articles culturels, tout en offrant aux administrateurs des outils de gestion efficaces.

### Contexte
La plateforme doit favoriser la publication d'articles sur divers sujets culturels comme la peinture, la musique, la littérature, et le cinéma. Un dashboard pour l'administration sera mis en place pour gérer utilisateurs, catégories et articles.

### Objectifs
- Création d'un environnement convivial pour les utilisateurs.
- Mise en place d'un backend robuste en PHP 8 avec une base de données sécurisée.
- Gestion des articles, catégories et utilisateurs.

### Technologies Requises
- **Langage** : PHP 8 (Programmation Orientée Objet)
- **Base de Données** : PDO pour interagir avec la base de données.

### User Stories
#### En tant qu'administrateur :
- **Gestion des catégories** : Créer, modifier, et supprimer des catégories.
- **Gestion des utilisateurs** : Consulter les profils utilisateurs.
- **Gestion des articles** : Accepter ou refuser les articles soumis.

#### En tant qu'utilisateur :
- **Inscription et connexion** : S’inscrire avec mon nom, e-mail, et mot de passe, et me connecter de manière sécurisée.
- **Navigation et affichage** : Explorer facilement les articles par catégorie et voir les derniers articles sur la page d'accueil.

#### En tant qu'auteur :
- **Création et gestion d'articles** : Créer, modifier ou supprimer des articles.

### Fonctionnalités SQL
- Trouver le nombre total d'articles publiés par catégorie.
- Identifier les auteurs les plus actifs.
- Calculer la moyenne d'articles publiés par catégorie.
- Créer une vue des derniers articles publiés dans les 30 derniers jours.
- Trouver les catégories sans articles associés.

### Modalités Pédagogiques
- **Durée de travail** : 5 jours
- **Date de lancement** : 30/12/2024 à 09:00
- **Date limite de soumission** : 03/01/2025 avant 23:59

### Modalités d'Évaluation
- **Présentation de 30 minutes** :
  - 10 minutes : Démonstration de livrable.
  - 10 minutes : Explication du code PHP / POO / SQL / UML.
  - 10 minutes : Mise en situation.

### Livrables
- Gestion des tâches sur un Scrum Board avec toutes les User Stories.
- Lien de Repository Github du projet (Code source + script SQL).
- Diagrammes UML :
  - Diagramme de classes.
  - Diagramme de cas d'utilisation.
- Lien de la présentation.

### Critères de Performance
- **Planification des tâches** : Utilisation de Jira pour planifier et suivre les tâches.
- **Commits Journaliers** : Suivi des changements via des commits journaliers sur Github.
- **Design Réactif** : Utilisation de Framework CSS pour une adaptabilité sur différents écrans.
- **Validation des formulaires** : Validation front-end et back-end pour la sécurité des données.
- **Sécurité** : Protection contre les attaques SQL Injection et XSS.

### Structure du Projet
La logique métier doit être séparée de l'architecture afin de garantir une maintenabilité optimale du code.

### Sécurité
- Utilisation de requêtes préparées pour éviter les injections SQL.
- Échappement des données pour prévenir les attaques XSS.
- Mise en place d'une page 404 personnalisée.

### Contact
Pour toute question ou clarification, veuillez contacter [edderkaouioussama@gmail.com].

