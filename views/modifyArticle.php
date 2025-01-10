<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
<section>
            <div id="myModal" class=" modifyModal   modal  fixed inset-0 bg-gray-900 bg-opacity-90 flex items-center justify-center z-50  modifier_article ">


                    <!-- MODIFY Article Form -->
                    <div class="bg-white/80 backdrop-blur-md rounded-2xl w-[50%] mt-4 shadow-xl p-8 mb-8 hover:shadow-2xl transition-all duration-300">
                        <h2 class="text-xl font-semibold mb-6 text-gray-800">Modifier Article</h2>
                        <form id="articleForm" class="space-y-6" action="../functions/updateArticle.php" method="post" enctype="multipart/form-data" >
                            <?php
                            require_once '../classes/auteur.php';
                            $id_article=$_GET['id'];
                            $auteur = new Auteur("", "", "", "", "", "","");
                            $auteur->showModifyArticle($id_article);
                            $result = $auteur->showModifyArticle($id_article);
                                          echo'  <div>
                                          <input class="hidden" name="id_article" value="'. $id_article.'">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                                <input
                                                    type="text" name="titre"
                                                    required
                                                    value="'.$result['titre'].'"
                                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                                                    placeholder="Enter article title...">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Categorie</label>';
                
                                                
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
                
                                               echo' <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                                                    <textarea name="content"
                                                        required
                                                        rows="8"
                                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-200"
                                                        placeholder="Write your article content here..."> '.$result['contenu'].' </textarea>
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
                                                    type="submit" name="update"
                                                    class="w-full py-3 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-200 font-medium">
                                                  modifier Article
                                                </button>';
                            

                                  
                                
                        ?>
                      
                           
                                
                        </form>
                    </div>
            </section>



</body>
</html>