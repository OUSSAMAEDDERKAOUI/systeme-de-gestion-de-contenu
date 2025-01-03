<?php

session_start();

require_once '../functions/checkRole.php';
if (!isAuth('admin')) {
    header('Location: ../views/' . $_SESSION['user_role'] . '.php');
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
                    Catégories
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
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-gray-500 text-sm"> Les Articles En Attente</h3>
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
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-gray-500 text-sm">Vues Totales</h3>
                                    <p class="text-2xl font-semibold text-gray-800">30K</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>

<section class="hidden" id="article">
<div class="w-[70%] ml-[15%] mb-8">
                        <!-- Articles en Attente -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold bold mb-4 text-gray-900">Articles en Attente de Validation</h3>
                            <div class="space-y-4">
                                <?php
                                require_once '../classes/admin.php';
                                $admin = new Admin("", "", "", "", "", "");
                                $rows = $admin->show_article();
                                if ($rows) {
                                    foreach ($rows as $row) {
                                        $id_article = $row['id_article'];
                                        echo ' <div class="flex items-center justify-between border-b pb-2">
                                <div>
                                    <h4 class="font-medium">' . $row['titreArticle'] . '</h4>
                                    <p class="text-sm text-gray-500">
                                      par ' . $row["prenom"] . ' ' . $row["nom"] . '   •   
                                       ' . $row['titreCategorie'] . ' •
                                       ' . $row['date_publication'] . '
                                        
                                    </p>
                                </div>';

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
                    <!-- Articles en Attente & Graphiques -->
                  
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
document.getElementById('auteur_button').onclick= function(){
    document.getElementById('auteur').classList.remove('hidden')
    document.getElementById('article').classList.add('hidden')
    document.getElementById('categorie').classList.add('hidden')
}
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




    </script>
</body>

</html>