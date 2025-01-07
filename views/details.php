<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../functions/checkRole.php';
if (!isAuth('membre')) {
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
        header('Location: ../views/' . $_SESSION['user_role'] . '.php');
}
else {
    header('Location: ../views/login.php');

}
}


?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - CultureConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="index.html" class="text-2xl font-bold text-green-600">MelodyHub</a>
                    </div>
                    <!-- Desktop Menu -->

                </div>
                <!-- Desktop Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-bell text-xl"></i>
                    </button>
                    <div class="relative">
                        <img  src="https://images.unsplash.com/photo-1494790108377-be9c29b29330"
                            alt="Profile"
                            class="h-10 w-10 rounded-full object-cover">
                        <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-400 border-2 border-white"></div>

                    </div>
                    <a href="../functions/logout.php" class="flex items-center px-6 py-3 hover:bg-purple-700 transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>


    </nav>

    <main class="container mx-auto px-4 py-8 mt-16 w-[80%] mx-auto px-4">
        <!-- Filtres -->
        <!-- <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Catégories</h2>
            <div class="category-filters">
                <button data-category="all" class="category-filter px-4 py-2 rounded-full bg-purple-600 text-white transition-colors duration-300">
                    Tous
                </button>
                <button data-category="Peinture" class="category-filter px-4 py-2 rounded-full bg-white text-purple-600 hover:bg-purple-100 transition-colors duration-300">
                    Classical
                </button>
                <button data-category="Musique" class="category-filter px-4 py-2 rounded-full bg-white text-purple-600 hover:bg-purple-100 transition-colors duration-300">
                    Pop
                </button>
                <button data-category="Littérature" class="category-filter px-4 py-2 rounded-full bg-white text-purple-600 hover:bg-purple-100 transition-colors duration-300">
                    Rock
                </button>

                <button data-category="Théâtre" class="category-filter px-4 py-2 rounded-full bg-white text-purple-600 hover:bg-purple-100 transition-colors duration-300">
                    Jazz
                </button>
            </div>
        </div> -->

        <!-- Articles Grid -->
        <section>



            <!-- <section class="m-12">
                <div class="articles-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                  <article class="bg-white rounded-lg shadow-lg overflow-hidden animate__animated animate__fadeIn">
                    <div class="relative">
                        <img src="../assets/img/photo-1511379938547-c1f69419868d.jpeg" alt="${article.title}" class="w-full h-48 object-cover">
                        <div class="absolute top-0 right-0 m-2">
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">
                                music
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <span>2024-12-31</span>
                            <span class="mx-2">•</span>
                            <span>50 vues</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">La Renaissance de la Musique Classique
                        </h3>
                        <p class="text-gray-600 mb-4">Comment la nouvelle génération redécouvre...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Par Jean Martin </span>
                            <a href="#" class="text-purple-600 hover:text-purple-800 transition-colors duration-300">
                                Lire la suite →
                            </a>
                        </div>
                       
                    </div>
                </article>             
               </div> -->



            <!-- //////////////////////////////////////////////////////////////////: -->


         

<div class="articles-grid grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
                    <?php


require_once '../classes/membre.php';

 $membre = new Membre("", "", "", "", "", "");



 $id_article=$_GET['id'];


$result = $membre->showDetails($id_article);
if ($result) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){

        $image=$row['image'];
                            echo '  <article class="bg-white rounded-lg shadow-lg overflow-hidden animate__animated animate__fadeIn">
    <div class="relative">
        <img src="'.htmlspecialchars($image).'" alt="" class="w-full h-96 object-cover">
       


        <div class="absolute top-0 right-0 m-2">
            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">
              ' . $row['categorieTitre'] . ' </span>
        </div>
    </div>
    <div class="p-6">';
     echo'<div class="mb-8">';
       echo' <h1 class="text-4xl font-bold text-gray-900 mb-4">' . $row['articleTitre'] . '</h1>
        
        <div class="flex items-center gap-4 mb-6">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-12 h-12 rounded-full" alt="Author">
            <div>
                <p class="font-semibold text-gray-900">' . ' ' . $row['nom'] . '  ' . $row['prenom'] . '  </p>
                <p class="text-gray-500 text-sm">Publié le ' . $row['date_publication'] . '</p>
            </div>
        </div>
    </div>
          <pre class="text-gray-800 mb-2 whitespace-pre-line">' . $row['contenu'] . '
        </pre>
        
      
    </div>
</article> ';
                        }
}
                    ?>

                </div>
<!-- Section likes -->
<div class="m-4 flex items-center gap-2">
    <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
        </svg>
        42 J'aime
    </button>
</div>

<!-- Section commentaires -->
<div class="comments-section mt-8">
    <h4 class="text-xl font-bold mb-4">Commentaires</h4>
    
    <!-- Formulaire de commentaire -->
    <form class="mb-6">
        <textarea 
            rows="3" 
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Ajouter un commentaire..."
        ></textarea>
        <button class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Publier
        </button>
    </form>

    <!-- Liste des commentaires -->
    <div class="space-y-4">
        <!-- Commentaire 1 -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-semibold">Jean Dupont</p>
                    <p class="text-sm text-gray-500">15/03/2024 14:30</p>
                </div>
            </div>
            <p class="mt-2 text-gray-700">
                Super article ! Très instructif et bien écrit.
            </p>
        </div>

        <!-- Commentaire 2 -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-semibold">Marie Martin</p>
                    <p class="text-sm text-gray-500">15/03/2024 15:45</p>
                </div>
            </div>
            <p class="mt-2 text-gray-700">
                Merci pour ces informations précieuses. J'ai beaucoup appris.
            </p>
        </div>

        <!-- Commentaire 3 -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-semibold">Pierre Durand</p>
                    <p class="text-sm text-gray-500">15/03/2024 16:20</p>
                </div>
            </div>
            <p class="mt-2 text-gray-700">
                Très intéressant ! J'aimerais en savoir plus sur ce sujet.
            </p>
        </div>
    </div>
</div>



                    <!-- Pagination -->
                    <div class="pagination flex justify-center space-x-2 mt-8">
                        <!-- Les boutons de pagination seront injectés ici par JavaScript -->
                    </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="text-white">
                    <h3 class="text-2xl font-bold">MelodyHub</h3>
                    <p class="mt-2 text-gray-400">Votre passerelle vers la culture</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>


    <div class="max-w-4xl mx-auto px-4 py-8">
    <!-- En-tête de l'article -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Comment créer une application web moderne en 2024</h1>
        
        <div class="flex items-center gap-4 mb-6">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-12 h-12 rounded-full" alt="Author">
            <div>
                <p class="font-semibold text-gray-900">Thomas Martin</p>
                <p class="text-gray-500 text-sm">Publié le 15 janvier 2024</p>
            </div>
        </div>
    </div>

    <!-- Image principale -->
    <div class="mb-8">
        <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6" 
             class="w-full h-[400px] object-cover rounded-xl shadow-lg" 
             alt="Article cover">
    </div>

    <!-- Contenu de l'article -->
    <div class="prose max-w-none mb-12">
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
            Le développement web moderne nécessite une approche holistique qui prend en compte à la fois les performances, 
            l'expérience utilisateur et la maintenabilité du code. Dans cet article, nous explorerons les meilleures 
            pratiques actuelles...
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Les fondamentaux</h2>
        <p class="text-gray-700 mb-6">
            Avant de se lancer dans le développement, il est crucial de bien comprendre les bases. 
            Cela inclut une solide connaissance de HTML, CSS et JavaScript...
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Les frameworks modernes</h2>
        <p class="text-gray-700 mb-6">
            React, Vue et Angular dominent actuellement le paysage du développement frontend. 
            Chacun a ses forces et ses cas d'utilisation spécifiques...
        </p>
    </div>

    <!-- Section Likes et Partage -->
    <div class="border-t border-b border-gray-200 py-6 mb-8">
        <div class="flex items-center gap-6">
            <button class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                </svg>
                <span class="font-medium">128 likes</span>
            </button>
        </div>
    </div>

    <!-- Section Commentaires -->
    <div class="mb-8">
        <h3 class="text-2xl font-bold mb-6">Commentaires (3)</h3>

        <!-- Formulaire de commentaire -->
        <div class="mb-8">
            <textarea 
                class="w-full p-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                rows="4"
                placeholder="Ajouter un commentaire..."></textarea>
            <button class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Publier
            </button>
        </div>

        <!-- Liste des commentaires -->
        <div class="space-y-6">
            <!-- Commentaire 1 -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center gap-4 mb-4">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                         class="w-10 h-10 rounded-full" alt="Commenter">
                    <div>
                        <p class="font-semibold">Sophie Bernard</p>
                        <p class="text-sm text-gray-500">Il y a 2 heures</p>
                    </div>
                </div>
                <p class="text-gray-700">Excellent article ! Les explications sont très claires et pertinentes.</p>
            </div>

            <!-- Commentaire 2 -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center gap-4 mb-4">
                    <img src="https://randomuser.me/api/portraits/men/46.jpg" 
                         class="w-10 h-10 rounded-full" alt="Commenter">
                    <div>
                        <p class="font-semibold">Marc Dubois</p>
                        <p class="text-sm text-gray-500">Il y a 5 heures</p>
                    </div>
                </div>
                <p class="text-gray-700">Très instructif, j'ai beaucoup appris. Merci pour le partage !</p>
            </div>

            <!-- Commentaire 3 -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center gap-4 mb-4">
                    <img src="https://randomuser.me/api/portraits/women/22.jpg" 
                         class="w-10 h-10 rounded-full" alt="Commenter">
                    <div>
                        <p class="font-semibold">Julie Martin</p>
                        <p class="text-sm text-gray-500">Il y a 1 jour</p>
                    </div>
                </div>
                <p class="text-gray-700">Pourriez-vous faire un article sur les tests unitaires aussi ?</p>
            </div>
        </div>
    </div>
</div>


    <script src="js/main.js"></script>
</body>

</html>