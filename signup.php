<?php
    include "connection.php";
    include "lib/validation.php";
        $nom = "";
        $email = "";
        $password="";
        $errors = [] ;
        $alertMessage = "";
        session_start();
        if ($_SERVER['REQUEST_METHOD']==='POST') {
        $nom = validate($_POST['nameS']);
        $email = validate($_POST['emailS']);
        $password = validate($_POST['passwordS']);
    
        if (empty($nom)) {
            $errors['nameError'] = "Le nom est requis.";
        }
        if (empty($email)) {
            $errors['emailError'] = "L'email est requis.";
        }
        if (empty($password)) {
            $errors['passwordError'] = "Le mot de passe est requis.";
        }

        if (empty($errors)) {
            $checkUser = $conn->prepare("SELECT id FROM user WHERE email = ?");
            $checkUser->bind_param("s", $email);
            $checkUser->execute();
            $result = $checkUser->get_result();

            if ($result->num_rows > 0) {
                $alertMessage = "Un compte avec cet email existe déjà.";
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stat = $conn->prepare("INSERT INTO user (nom, email, password) VALUES (?, ?, ?)");
                $stat->bind_param("sss", $nom, $email, $passwordHash);

                if ($stat->execute()) {
                    $stat->close();
                    header('Location: login.php');
                    exit;
                } else {
                    $errors['dbError'] = "Erreur lors de l'insertion dans la base de données.";
                }
            }
            $checkUser->close();
        }

    }
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
        
        <h2 class="text-3xl font-bold text-center form-title mb-6">Créer un compte</h2>
        <?php if (!empty($alertMessage)): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>
                <?= $alertMessage ?>
            </div>
        </div>
        <?php endif; ?>
        
        <form id="" action="" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Nom</label>
                <input 
                    type="text" 
                    id="name" 
                    name="nameS" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre nom"
                    value="<?= $nom?>"
                    >
                <?php if (isset($errors['nameError'])): ?>
                    <p class="name text-red-500 text-sm mt-1"><?= $errors['nameError'] ?></p>
                <?php endif; ?>
            </div>

            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Adresse Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="emailS" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre email"
                    value="<?= $email?>"
                    >
                    <?php if (isset($errors['emailError'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['emailError'] ?></p>
                <?php endif; ?>
            </div>

            
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Mot de Passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="passwordS" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre mot de passe"
                    value="<?= $password?>"
                    >
                    <?php if (isset($errors['passwordError'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['passwordError'] ?></p>
                <?php endif; ?>
            </div>


            
            <button 
                type="submit" 
                class="w-full py-2 px-4 bg-[#c9ab81] text-gray-800 font-semibold rounded-lg hover:bg-[#b09270] transition duration-300">
                S'inscrire
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            Vous avez déjà un compte ?
            <a href="login.php" class="text-[#c9ab81] hover:underline">Se connecter</a>
        </p>
    </div>
</body>
</html>
