<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../functions/checkRole.php';
if (!isAuth('auteur')) {
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
        header('Location: ../views/' . $_SESSION['user_role'] . '.php');
}
else {
    header('Location: ../views/login.php');

}
}
$image_user= $_SESSION['user_image'];

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Auteur - MelodyHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-purple-800 to-purple-900 text-white">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-purple-600 flex items-center justify-center">
                        <i class="fas fa-feather-alt text-xl"></i>
                    </div>
                    <div>
                    <div class="relative">
                      
                        <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-400 border-2 border-white"></div>
                    </div>
                        <h1 class="text-xl font-bold">MelodyHub</h1>
                        <p class="text-purple-300 text-sm">Espace Auteur</p>
                    </div>
                   
                </div>
            </div>

            <nav class="mt-6">
                <div class="px-6 py-3">
                    <p class="text-xs uppercase text-purple-300">Menu Principal</p>
                </div>
                <div id="dashboardSection" class="flex items-center px-6 py-3 bg-purple-700 border-r-4 border-white cursor-pointer">
                    <i class="fas fa-chart-line mr-3"></i>
                    Dashboard
                </div>
                <div id="allarticleSection" class="flex items-center px-6 py-3 hover:bg-purple-700 transition-colors duration-200 cursor-pointer">
                    <i class="fas fa-pencil-alt mr-3"></i>
                    Mes Articles
                </div>
                <div id="addArticleSection" class="flex items-center px-6 py-3 hover:bg-purple-700 transition-colors duration-200cursor-pointer">
                    <i class="fas fa-plus-circle mr-3"></i>
                    Nouvel Article
                </div>

                <div class="px-6 py-3 mt-6">
                    <p class="text-xs uppercase text-purple-300">Paramètres</p>
                </div>

                <a href="../functions/logout.php" class="flex items-center px-6 py-3 hover:bg-purple-700 transition-colors duration-200 cursor-pointer">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Déconnexion
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Top Navigation -->
            <nav class="bg-white shadow-md">
                <div class="mx-auto px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <button class="text-gray-500 hover:text-gray-600">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                            <div class="ml-4">
                                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                                <p class="text-sm text-gray-600">Bienvenue, </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="p-2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-bell text-xl"></i>
                            </button>
                            <div class="relative">
                            <?php
                        echo'<img src="'. htmlspecialchars($image_user).'"
                    
                            alt="Profile"
                            class="h-10 w-10 rounded-full object-cover">';
                            ?>
                                <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-400 border-2 border-white"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <section id="auth_Dashboard" class="p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 animate__animated animate__fadeIn hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Articles</p>
                                <?php
                                require_once '../classes/auteur.php';
                                $auteur = new Auteur("", "", "", "", "", "","");
                                $id_auteur = $_SESSION['user_id'];
                                $result = $auteur->allArticle($id_auteur);

                                echo ' <p class="text-2xl font-semibold text-gray-800">' . $result['nbr_article'] . '</p>'

                                ?>

                            </div>
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-newspaper text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 animate__animated animate__fadeIn hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Articles Approuvés</p>
                                <?php
                                require_once '../classes/auteur.php';
                                $auteur = new Auteur("", "", "", "", "", "","");
                                $id_auteur = $_SESSION['user_id'];
                                $result = $auteur->confirmedArticle($id_auteur);

                                echo ' <p class="text-2xl font-semibold text-gray-800">' . $result['nbr_article'] . '</p>'

                                ?>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 animate__animated animate__fadeIn hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">En Attente</p>
                                <?php
                                require_once '../classes/auteur.php';
                                $auteur = new Auteur("", "", "", "", "", "","");
                                $id_auteur = $_SESSION['user_id'];
                                $result = $auteur->rejectedArticle($id_auteur);

                                echo ' <p class="text-2xl font-semibold text-gray-800">' . $result['nbr_article'] . '</p>'

                                ?> <p class="text-xs text-yellow-500 mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    En cours de révision
                                </p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts & Recent Articles -->
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 ml-auto mr-auto">

                    <!-- Recent Articles -->
                    <div class="bg-white rounded-xl shadow-sm p-6 ">
                        <div class="flex items-center justify-between mb-6 ">
                            <h3 class="text-lg font-semibold text-gray-800">Articles Approuvés</h3>
                            <button class="text-purple-600 hover:text-purple-700">
                                Voir tout <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>

                        <?php
                        $id_user = $_SESSION['user_id'];

                        $rows = $auteur->showapprovedArt($id_user);
                        if (is_array($rows) && count($rows) > 0) {

                            foreach ($rows as $row) {
                                $image= $row['image'] ;
                                echo ' <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <img src="'.htmlspecialchars($image).' " 
                                     alt="Article" 
                                     class="h-16 w-16 rounded-lg object-cover">
                                <div class="ml-4 flex-1">
                                    <h4 class="text-sm font-semibold text-gray-800">' . $row['articleTitre'] . '</h4>
                                    <p class="text-sm text-gray-600">Publié le ' . ' ' . $row['date_publication'] . '</p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">' . $row['statut'] . '</span>
                                        <span class="text-xs text-gray-500 ml-2">
                                            <i class="fas fa-eye mr-1"></i> 30 vues
                                        </span>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
    
                            
                        </div>';
                            }
                        }
                        ?>





                    </div>
                </div>
            </section>


            <section>
                <div id="newArticle" class=" w-[80%] ml-[10%] hidden mt-32 ">


                    <!-- Create Article Form -->
                    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 mb-8 hover:shadow-2xl transition-all duration-300">
                        <h2 class="text-xl font-semibold mb-6 text-gray-800">Create New Article</h2>
                        <form id="articleForm" class="space-y-6" action="../functions/insertArticle.php" method="post" enctype="multipart/form-data" >
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <input
                                    type="text" name="titre"
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                                    placeholder="Enter article title...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Categorie</label>

                                <?php
                                $auteur->showCategory();
                                $rows = $auteur->showCategory();
                                echo '  <select 
                              required name="category" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                            >';
                                foreach ($rows as $row) {
                                    $id_category = $row['id_categorie'];
                                    echo '<option value="' . htmlspecialchars($id_category) . ' ">' . $row['titre'] . '</option>';
                                }


                                echo '</select>
                            </div>';

                                ?>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                                    <textarea name="content"
                                        required
                                        rows="8"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                                        placeholder="Write your article content here..."></textarea>
                                </div>
                                
                                <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
    <?php


// Récupérer les tags


    $rows = $auteur->showTag(); 
    if ($rows) {
        foreach ($rows as $row) {
            $id_tag = $row['id_tag'];
            $nom_tag = htmlspecialchars($row['nom_tag']);
            echo '<div class="flex items-center mb-2">';
            echo '<input type="checkbox" name="tag[]" value="' . $id_tag . '" id="tag' . $id_tag . '" class="mr-2">';
            echo '<label for="tag' . $id_tag . '" class="text-sm text-gray-700">' . $nom_tag . '</label>';
            echo '</div>';
        }
    }
    ?>
</div>

                                <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">image</label>
                                <input
                                    type="file" name="image"
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                                    placeholder="Enter article title...">
                            </div>
                                <button
                                    type="submit" name="insert"
                                    class="w-full py-3 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-200 font-medium">
                                    Publish Article
                                </button>
                        </form>
                    </div>
            </section>

<!-- /////////////////////////////allArticle///////////////////////////////////////// -->

         <section id="allArticle" class="m-12 hidden">
                <div class="articles-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <?php

                    $id_user = $_SESSION['user_id'];
                    $rows = $auteur->showArticle($id_user);
                    if (is_array($rows) && count($rows) > 0) {
                        foreach ($rows as $row) {
                            $image= $row['image'] ;
                            $id_article=$row['id_article'];
                            echo '  <article class="bg-white rounded-lg shadow-lg overflow-hidden animate__animated animate__fadeIn">
    <div class="relative">
        <img class="w-[700px] h-[400px] object-cover" src="'.htmlspecialchars($image).'">
       


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
        <h3 class="text-xl font-bold text-gray-800 mb-2">' . $row['articleTitre'] . '
        </h3>
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Par' . ' ' . $row['nom'] . '  ' . $row['prenom'] . '  </span>
        </div>
        <div class="flex items-center justify-between">
<a href="./modifyArticle.php?id='. $id_article.'">
 <button type="button" class="  modifier_article  text-purple-600 hover:text-purple-800 transition-colors duration-300">                            
            <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">modifier</span>
          </button>
</a>
         

          <a href="../functions/deleteArticle.php?id= ' . htmlspecialchars($row['id_article']) . '" class="text-purple-600 hover:text-purple-800 transition-colors duration-300">
            <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">Supprimer</span>
          </a>
          
      </div>
    </div>
</article> ';
                        }
                    }
                    ?>

                </div>

               <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->

            <!-- modifie article -->

            

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->




            </section>
           



            <script>

document.getElementById('addArticleSection').onclick=function(){
    document.getElementById('newArticle').classList.remove('hidden');
    document.getElementById('auth_Dashboard').classList.add('hidden');
    document.getElementById('allArticle').classList.add('hidden');
}

document.getElementById('allarticleSection').onclick=function(){
    document.getElementById('newArticle').classList.add('hidden');
    document.getElementById('auth_Dashboard').classList.add('hidden');
    document.getElementById('allArticle').classList.remove('hidden');
}

document.getElementById('dashboardSection').onclick=function(){
    document.getElementById('newArticle').classList.add('hidden');
    document.getElementById('auth_Dashboard').classList.remove('hidden');
    document.getElementById('allArticle').classList.add('hidden');
}




const modifier_article = document.querySelectorAll('.modifier_article');
        const modals = document.querySelectorAll('.modifyModal');
        modifier_article.forEach((button, index) => {
            button.addEventListener('click', function(e) {
                modals[index].classList.remove('hidden');
            });
        })


            </script>



</body>




</html>