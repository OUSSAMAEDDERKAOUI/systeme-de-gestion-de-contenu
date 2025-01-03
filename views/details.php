<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../functions/checkRole.php';
if (!isAuth('membre')) {
    header('Location: ../views/' . $_SESSION['user_role'] . '.php');
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
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330"
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
        <div class="mb-8">
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
        </div>

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
                            echo '  <article class="bg-white rounded-lg shadow-lg overflow-hidden animate__animated animate__fadeIn">
    <div class="relative">
        <img src="../assets/img/photo-1511379938547-c1f69419868d.jpeg" alt="" class="w-full h-48 object-cover">
       


        <div class="absolute top-0 right-0 m-2">
            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">
              ' . $row['categorieTitre'] . ' </span>
        </div>
    </div>
    <div class="p-6">
        <div class="flex items-center text-sm text-gray-600 mb-2">
            <span>' . $row['date_publication'] . '</span>
            <span class="mx-2">•</span>
            <span>50 vues</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="font-bold m-6 text-blue-900">Par' . ' ' . $row['nom'] . '  ' . $row['prenom'] . ' : </span> 
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">' . $row['articleTitre'] . '
        </h3>
          <h3 class="text-xl font-bold text-gray-800 mb-2">' . $row['contenu'] . '
        </h3>
        
      
    </div>
</article> ';
                        }
}
                    ?>

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

    <script src="js/main.js"></script>
</body>

</html>