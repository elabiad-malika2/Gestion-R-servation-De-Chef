<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1f2937; /* Couleur sombre */
            color: #c9ab81; /* Couleur de texte principale */
        }
        .form-title {
            color: #c9ab81; /* Couleur des titres */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full">
        <!-- Titre -->
        <h2 class="text-3xl font-bold text-center form-title mb-6">Créer un compte</h2>

        <!-- Formulaire -->
        <form id="signup-form" action="#" method="POST">
            <!-- Champ Nom -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Nom</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre nom"
                    required>
            </div>

            <!-- Champ Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Adresse Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre email"
                    required>
            </div>

            <!-- Champ Mot de Passe -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Mot de Passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    placeholder="Entrez votre mot de passe"
                    required>
            </div>

            <!-- Champ Rôle (lecture seule) -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium mb-2">Rôle</label>
                <input 
                    type="text" 
                    id="role" 
                    name="role" 
                    class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#c9ab81]"
                    value="user" 
                    readonly>
            </div>

            <!-- Bouton -->
            <button 
                type="submit" 
                class="w-full py-2 px-4 bg-[#c9ab81] text-gray-800 font-semibold rounded-lg hover:bg-[#b09270] transition duration-300">
                S'inscrire
            </button>
        </form>

        <!-- Lien vers la connexion -->
        <p class="text-sm text-center mt-4">
            Vous avez déjà un compte ?
            <a href="login.php" class="text-[#c9ab81] hover:underline">Se connecter</a>
        </p>
    </div>
</body>
</html>
