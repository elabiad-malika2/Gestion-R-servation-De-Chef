<?php
include "connection.php";
include "lib/validation.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = validate($_POST['emailL']);
    $password = validate($_POST['passwordL']);
    
    $stm = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stm->bind_param('s', $email);
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
        $connrow = $result->fetch_assoc();
        $isVerified = password_verify($password, $connrow['password']);

        if ($isVerified) {
            $_SESSION['id_Login'] = $connrow['id'];
            $_SESSION['role'] = $connrow['role'];

            if ($connrow['role'] == 'admin') {
                header('Location:DashboardMenu.php');
            } else {
                header('Location:index.php');
            }
            exit();
        } else {
            $_SESSION["error"] = "Invalid password";
        }
    } else {
        $_SESSION["error"] = "Invalid email";
    }

    header('Location:login.php');
    $stm->close();
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1f2937; 
            color: #c9ab81; 
        }
        .form-title {
            color: #c9ab81; 
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full">
        
        <h2 class="text-3xl font-bold text-center form-title mb-6">Se Connecter</h2>

        
        <form id="login-form" action="#" method="POST">
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Adresse Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="emailL" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre email"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Mot de Passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="passwordL" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre mot de passe"
                    required>
            </div>
            <div class="flex items-center mb-4">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="h-4 w-4 text-[#c9ab81] bg-gray-700 border-gray-600 rounded focus:ring-[#c9ab81]">
                <label for="remember" class="ml-2 text-sm">Se souvenir de moi</label>
            </div>
            <button 
                type="submit" 
                class="w-full py-2 px-4 bg-[#c9ab81] text-gray-800 font-semibold rounded-lg hover:bg-[#b09270] transition duration-300">
                Se Connecter
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            Vous n'avez pas de compte ?
            <a href="signup.php" class="text-[#c9ab81] hover:underline">Créer un compte</a>
        </p>
    </div>
</body>
</html>
