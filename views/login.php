<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../functions/checkRole.php';
if (!isAuth('autre')) {
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
        header('Location: ../views/' . $_SESSION['user_role'] . '.php');
}
else {
    header('Location: ../views/login.php');

}
}




?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CultureConnect - Login</title>
    <link rel="icon" type="../assets/img/logo.png" href="../../assets/img/logo.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
    <main class="redirection flex justify-center drop-shadow-2xl items-center h-screen relative ">
    <div class="absolute inset-0">
        <img src="../assets/img/pngtree-an-orchestra-in-a-large-auditorium-image_2930616.jpg" alt="Background Image" class="object-cover w-full h-full ">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-green-500 opacity-70"></div>
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg animate__animated animate__fadeIn">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Connectez-vous à votre compte
                </h2>
                
            </div>
            <form method="POST" action="../functions/login.php" id="loginForm" class="mt-8 space-y-6">
                <div class="rounded-md shadow-sm flex flex-col gap-5">
                    <div>
                        <label for="email" class="sr-only">Adresse email</label>
                        <input id="email" name="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Adresse email">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Mot de passe">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-purple-600 hover:text-purple-500">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" name="login" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-lock"></i>
                        </span>
                        Se connecter
                    </button>
                    <p class="mt-2 text-center text-sm text-gray-600">
                 
                    <a href="signup.php" class="font-medium text-purple-600 hover:text-purple-500">
                        créez un nouveau compte ?
                    </a>
                </p>
                </div>
            </form>
        </div>
    </main>
</body>
</html>