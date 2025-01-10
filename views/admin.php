<?php

session_start();

require_once '../functions/checkRole.php';
if (!isAuth('admin')) {
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
    <title>Dashboard Admin - MelodyHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed w-64 h-full bg-gray-900 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">MelodyHub</h1>
                <p class="text-gray-400">
                    <?php echo htmlspecialchars($_SESSION['user_prenom']) . ' ' . htmlspecialchars($_SESSION['user_nom']); ?> </p>
            </div>

            <nav class="mt-6">
                <div id="dashboard_button"  class="block py-3 px-6 bg-gray-800">
                    Dashboard
                </div>
                <div id="category_button" class="block py-3 px-6 hover:bg-gray-800 transition-colors duration-200 cursor-pointer">
                    Catégories et tags
                </div>
                <div id="Article_button" class="block py-3 px-6 hover:bg-gray-800 transition-colors duration-200 cursor-pointer">
                    Articles
                </div>
                <div id="auteur_button"  class="block py-3 px-6 hover:bg-gray-800 transition-colors duration-200 cursor-pointer">
                    Auteurs
                </div>
                <a href="../functions/logout.php" class="flex items-center px-6 py-3 hover:bg-red-500 transition-colors duration-200 cursor-pointer">
                    <i class="fas fa-sign-out-alt "></i>
                    Déconnexion
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="ml-64 p-8">
            <section class="" id="statistique">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-16 mb-8">
                    <!-- Total Articles -->
                    <div class="bg-white rounded-lg shadow-md p-6 animate__animated animate__fadeIn">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Total Articles</h3>
                                <?php
                                require_once '../classes/admin.php';
                                $admin = new Admin("", "", "", "", "", "");
                                $result = $admin->allArticle();

                                echo ' <p class="text-2xl font-semibold text-gray-800">' . $result['nbr_article'] . '</p>
                            </div>'
                                ?>
                            </div>
                        </div>

                        <!-- Articles en Attente -->
                        <div class="bg-white rounded-lg shadow-md p-6 animate__animated animate__fadeIn">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-gray-500 text-sm"> Les Articles Rejeter</h3>
                                    <?php
                                    require_once '../classes/admin.php';
                                    $admin = new Admin("", "", "", "", "", "");
                                    $result = $admin->rejectedArticle();

                                    echo ' <p class="text-2xl font-semibold text-gray-800">' . $result['nbr_article'] . '</p>'
                                    ?>

                                </div>
                            </div>
                        </div>

                        <!-- Auteurs -->
                        <div class="bg-white rounded-lg shadow-md p-6 animate__animated animate__fadeIn">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-gray-500 text-sm">Les Articles Approuvée </h3>

                                    <?php
                                    require_once '../classes/admin.php';
                                    $admin = new Admin("", "", "", "", "", "");
                                    $result = $admin->confirmedArticle();

                                    echo ' <p class="text-2xl font-semibold text-gray-800">' . $result['nbr_article'] . '</p>'
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Vues Totales -->
                        <div class="bg-white rounded-lg shadow-md p-6 animate__animated animate__fadeIn">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>    
                                
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-gray-500 text-sm"> Les Articles En Attente</h3>
                                    <?php
                                    require_once '../classes/admin.php';
                                    $admin = new Admin("", "", "", "", "", "");
                                    $result = $admin->PendingArticle();

                                    echo ' <p class="text-2xl font-semibold text-gray-800">' . $result['nbr_article'] . '</p>'
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    </section>

<section class="hidden" id="article">
<div class="w-[70%] ml-[15%] mb-8">
<div class="bg-white shadow-sm">

        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Articles en Attente de Validation</h1>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
            </div>
        </div>
    </div>
                        <!-- Articles en Attente -->
                        <div class="bg-white rounded-lg shadow-md p-6 ">
                            <h3 class="text-lg font-bold bold mb-4 text-gray-900"></h3>
                            <div class="space-y-4">
                                <?php
                                require_once '../classes/admin.php';
                                $admin = new Admin("", "", "", "", "", "");
                                $rows = $admin->show_article();
                                if ($rows) {
                                    foreach ($rows as $row) {
                                        $id_article = $row['id_article'];
                                        echo ' <div class="flex flex-column items-center justify-between border-b pb-2">
                                <div>
                                    <h4 class="font-medium">' . $row['titreArticle'] . '</h4>
                                    <p class="text-sm text-gray-500">
                                      par ' . $row["prenom"] . ' ' . $row["nom"] . '   •   
                                       ' . $row['titreCategorie'] . ' •
                                       ' . $row['date_publication'] . '
                                        
                                    </p>
                                </div>';
                                require_once '../classes/article_tag.php';
                                $TagArticle=new TagArticle("","");
                               $rows= $TagArticle->getTagsByArticle($id_article);
                               if(count($rows) > 0){
                                echo'<div class="flex  text-center gap-2 m-4 gap-2 m-4">';
                                foreach($rows as $result){
                                   echo' <div class="px-3 py-1  text-blue-600 rounded-full text-sm"># '.$result['nom_tag'].'</div>';
                                }
                                echo'</div>';

                               }


                                        echo ' <div class="flex space-x-2">
                              <a href="../functions/approuveArticle.php?id=' . htmlspecialchars($id_article) . '">
                              <button 
                                        class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                        Approuver
                                    </button>
                              </a>
                                    
                                
                                </div>
                            </div>';
                                    }
                                }
                                ?>
                            </div>

                        </div>

                    </div>


                    <!-- comments -->
 
<section class="bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Modération des Commentaires</h1>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Rechercher un commentaire...">
        </div>
    </div>

    <!-- Comments List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
            

                <!-- Comment i -->
                 <?php
                 require_once '../classes/comentaires.php';

                 $comment = new Commentaire("", "", "", "", "", "");

                            $rows=$comment->showReviewComment();
                            if($rows){
                                foreach($rows as $row){
                                    $id_comment=$row['id_comment'];
                                    echo '<li class="hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                                <span class="text-lg font-medium text-gray-600">P</span>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-sm font-medium text-gray-900">' . $row["prenom"] . ' ' . $row["nom"] . '</h3>
                                                <p class="text-sm text-gray-500">' . $row['titre'] .'</p>
                                            </div>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-600"> '. $row['contenu'] .'</p>
                                    </div>
                                    <div class="ml-6 flex items-center space-x-4">
                                        <span class="text-sm text-gray-500">' . $row['date_soumission'] .'</span>
                                        <div class="flex space-x-2">
                                        <a href="../functions/acceptecomment.php?id=' . htmlspecialchars($id_comment) . '">
                                        <button class="inline-flex items-center p-2 border border-transparent rounded-full text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg>
                                            </button>
                                        </a>
                                        <a href="../functions/removeComment.php?id=' . htmlspecialchars($id_comment) . '">
                                            <button class="inline-flex items-center p-2 border border-transparent rounded-full text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           </li>';
                           

                                }
                            }




                            
                           ?>
                </div>

            </ul>
        </div>

<!-- ----------------------------------- nouveau affichage de validation des article ---------------------------------------------- -->

        <section class="max-w-7xl mx-auto p-6">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Articles en attente de validation</h2>
            <p class="text-slate-600">8 articles nécessitent votre attention</p>
        </div>

        <!-- Liste des articles -->
        <div class="space-y-4">
            <!-- Article 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" 
                                 alt="Author" 
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h3 class="font-semibold text-slate-800">Thomas Durant</h3>
                                <p class="text-sm text-slate-500">Soumis le 15 Mars 2024</p>
                            </div>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-900 mb-2">
                            Les meilleures pratiques en React 2024
                        </h4>
                        <p class="text-slate-600 mb-4 line-clamp-2">
                            Une exploration approfondie des patterns modernes et des optimisations de performance...
                        </p>
                        <div class="flex gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm">React</span>
                            <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-sm">Performance</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors">
                            Approuver
                        </button>
                        <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                            Refuser
                        </button>
                    </div>
                </div>
            </div>

            <!-- Article 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop" 
                                 alt="Author" 
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h3 class="font-semibold text-slate-800">Marie Lefebvre</h3>
                                <p class="text-sm text-slate-500">Soumis le 14 Mars 2024</p>
                            </div>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-900 mb-2">
                            Introduction à l'Architecture Microservices
                        </h4>
                        <p class="text-slate-600 mb-4 line-clamp-2">
                            Guide complet sur la conception et l'implémentation des microservices...
                        </p>
                        <div class="flex gap-2 mb-4">
                            <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-sm">Architecture</span>
                            <span class="px-3 py-1 bg-teal-50 text-teal-600 rounded-full text-sm">Microservices</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors">
                            Approuver
                        </button>
                        <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                            Refuser
                        </button>
                    </div>
                </div>
            </div>

            <!-- Article 3 -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop" 
                                 alt="Author" 
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h3 class="font-semibold text-slate-800">Pierre Martin</h3>
                                <p class="text-sm text-slate-500">Soumis le 13 Mars 2024</p>
                            </div>
                        </div>
                        <h4 class="text-xl font-semibold text-slate-900 mb-2">
                            Sécurité des Applications Web Modernes
                        </h4>
                        <p class="text-slate-600 mb-4 line-clamp-2">
                            Découvrez les meilleures pratiques pour sécuriser vos applications web...
                        </p>
                        <div class="flex gap-2 mb-4">
                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-sm">Sécurité</span>
                            <span class="px-3 py-1 bg-gray-50 text-gray-600 rounded-full text-sm">Web</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors">
                            Approuver
                        </button>
                        <button class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                            Refuser
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!-- ----------------------------------- nouveau affichage de validation des article ---------------------------------------------- -->


</section>

                 









                    
            </section>
            <!-- categorie section -->
            <section class="hidden" id="categorie">
                <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 mb-8 hover:shadow-2xl transition-all duration-300">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Créer nouvelle categorie</h2>
                    <form id="articleForm" class="space-y-6" action="../functions/addCategory.php" method="POST">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" required name="category"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                                placeholder="Entrer le titre de la nouvelle categorie">
                        </div>
                        <button

                            type="submit" name="addCategory"
                            class="w-full py-3 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-200 font-medium">
                            Ajouter la nouvelle Catégorie
                        </button>
                    </form>
                </div>


                <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 mb-8 hover:shadow-2xl transition-all duration-300">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Créer nouvelle Tag</h2>
                    <form id="articleForm" class="space-y-6" action="../functions/addtag.php" method="POST">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" required name="tag"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                                placeholder="Entrer le titre de la nouvelle tag">
                        </div>
                        <button

                            type="submit" name="addTag"
                            class="w-full py-3 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-200 font-medium">
                            Ajouter la nouvelle tag
                        </button>
                    </form>
                </div>




                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Toutes les categories</h3>
                    <div class="space-y-4">
                        <?php
                        require_once '../classes/admin.php';
                        $admin = new Admin("", "", "", "", "", "");
                        $rows = $admin->showCategory();
                        if ($rows) {
                            foreach ($rows as $row) {
                                $id_category= $row['id_categorie'];
                                echo '<div class="flex items-center justify-between border-b pb-2">';
                                echo "<div>
                                    <h4 class='font-medium'>" . $row['titre'] . "</h4>";
                                echo '  <p class="text-sm text-gray-500">
                                        Par ' . $row["prenom"] . ' ' . $row["nom"] . '    •   ' . $row["dateCreation"] . '
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                <a href="../functions/removeCategory.php?id='. htmlspecialchars($id_category) .' ">
                                    <button 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Rejeter
                                    </button>
                                </a>
                                    
                                </div>
                            </div>';
                            }
                        }

                        ?>

                    </div>

                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Toutes les tags</h3>
                    <div class="space-y-4">
                        <?php
                        $result = $admin->showTag();
                        if ($result) {
                            foreach ($result as $row) {
                                $id_tag= $row['id_tag'];
                                echo '<div class="flex items-center justify-between border-b pb-2">';
                                echo "<div>
                                    <h4 class='font-medium'>" . $row['nom_tag'] . "</h4>";
                                echo '  <p class="text-sm text-gray-500">
                                        Par ' . $row["prenom"] . ' ' . $row["nom"] . '    •   ' . $row["date_creation"] . '
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                <a href="../functions/removetag.php?id='. htmlspecialchars($id_tag) .' ">
                                    <button 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Rejeter
                                    </button>
                                </a>
                                    
                                </div>
                            </div>';
                            }
                        }

                        ?>

                    </div>

                </div>


            </section>
            <!-- Utilisateurs section  -->
            <section class="hidden" id="auteur">

                <div class="bg-white rounded-lg shadow-md mt-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Les Auteurs de notre plateforme</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider text-center  font-x-bold">Auteur</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider text-center font-x-bold">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider text-center font-bold">Les articles Approuvés</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider text-center font-bold">Les articles Rejeter</th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                    require_once '../classes/admin.php';
                                    $admin = new Admin("", "", "", "", "", "");
                                    $rows = $admin->showAuteur();
                                    if ($rows) {
                                        foreach ($rows as $row) {
                                            echo '  <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-700">' . $row["prenom"] . ' ' . $row["nom"] . '</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">' . $row["email"] . ' </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700 text-center font-bold">' . $row["nbr_article_confirmer"] . ' </td>
                                                <td class="px-6 py-4 text-sm text-red-500 text-center font-bold">' . $row["nbr_article_annuler"] . ' </td>
                                                 
                                            </tr>';
                                        }
                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </section>
    </div>
    </div>

    <script>

document.getElementById('Article_button').onclick= function(){
    document.getElementById('auteur').classList.add('hidden')
    document.getElementById('article').classList.remove('hidden')
    document.getElementById('categorie').classList.add('hidden')
}
document.getElementById('category_button').onclick= function(){
    document.getElementById('auteur').classList.add('hidden')
    document.getElementById('article').classList.add('hidden')
    document.getElementById('categorie').classList.remove('hidden')
}


document.getElementById('auteur_button').onclick= function(){
    document.getElementById('auteur').classList.remove('hidden')
    document.getElementById('article').classList.add('hidden')
    document.getElementById('categorie').classList.add('hidden')
}




    </script>
</body>

</html>