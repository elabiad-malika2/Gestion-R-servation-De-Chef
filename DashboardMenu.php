<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Thème Sombre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }
        td {
            border-bottom-width: 1px;
            border-collapse: collapse;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                screens: {
                    'md': '768px',
                },
                extend: {
                    colors: {
                        primary: '#5051FA',
                        borderColor: '#5f5d5d',
                        bgcolor: '#1f2937', /* Couleur sombre pour le fond */
                        cardColor: '#2d3748', /* Couleur sombre pour les cartes */
                        textColor: '#c9ab81', /* Texte principal */
                    },
                    fontFamily: {
                        'title': ['Poppins', 'sans-serif'],
                        'bigTitle': ['"Myriad Pro"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bgcolor text-textColor min-h-screen">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-52 bg-gray-800 border-r border-gray-700 min-h-full flex flex-col items-center gap-4 py-6">
        <div class="drop-shadow-xl">
        <h1 class="text-2xl font-bold text-white">Chef<span class="text-[#c9ab81]">Gourmet</span></h1>
        </div>
        <nav class="mt-6 space-y-4">
            <a href="" class="flex gap-4 px-4 py-2 rounded-2xl text-gray-300 hover:bg-gray-700"><i class="fa fa-home"></i> Dashboard</a>
            <a href="" class="flex gap-4 px-4 py-2 rounded-2xl text-gray-300 hover:bg-gray-700"><i class="fa fa-utensils"></i> Menu</a>
            <a href="" class="flex gap-4 px-4 py-2 rounded-2xl text-gray-300 hover:bg-gray-700"><i class="fa fa-calendar-check"></i> Réservations</a>
            <a href="" class="flex gap-4 px-4 py-2 rounded-2xl text-gray-300 hover:bg-gray-700"><i class="fa fa-chart-bar"></i> Statistiques</a>
        </nav>
    </aside>
    <!-- Main Content -->
    <div class="flex-1">
        <!-- Header -->
        <header class="h-20 bg-gray-900 border-b border-gray-700 flex items-center px-8">
            <div class="flex items-center gap-2">
                <input class="bg-gray-700 text-white placeholder-gray-400 w-64 px-4 py-2 rounded-lg outline-none" type="search" placeholder="Search anything here">
                <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-indigo-600"><i class="fa fa-search"></i></button>
            </div>
            <div class="ml-auto flex items-center gap-6">
                <img src="img/settings.svg" alt="Settings" class="cursor-pointer w-6 h-6">
                <img src="img/Icon.svg" alt="Notifications" class="cursor-pointer w-6 h-6">
                <button class="bg-gray-800 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-700 flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-600 rounded-full"></div>
                    Admin
                </button>
            </div>
        </header>
        <!-- Section -->
        <section class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-xl font-semibold">Menu</h1>
                <button id="add-etd" onclick="document.getElementById('modal').classList.remove('hidden')" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-indigo-600">
                    <i class="fa fa-plus-circle"></i> Ajouter Menu
                </button>
            </div>
            <div class="grid grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-cardColor p-4 rounded-lg shadow-lg">
                    <img src="heroChef.jpg" alt="Plat Signature" class="w-full h-40 rounded-md mb-4 object-cover">
                    <h2 class="text-lg font-semibold mb-2 text-textColor">Plat Signature</h2>
                    <p class="text-gray-400 mb-4">Un plat préparé avec des ingrédients de qualité pour un goût exceptionnel.</p>
                    <div class="flex justify-end gap-4">
                        <button class="bg-gray-700 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-600"><i class="fa fa-edit"></i></button>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <!-- card 2 -->
                <div class="bg-cardColor p-4 rounded-lg shadow-lg">
                    <img src="heroChef.jpg" alt="Plat Signature" class="w-full h-40 rounded-md mb-4 object-cover">
                    <h2 class="text-lg font-semibold mb-2 text-textColor">Plat Signature</h2>
                    <p class="text-gray-400 mb-4">Un plat préparé avec des ingrédients de qualité pour un goût exceptionnel.</p>
                    <div class="flex justify-end gap-4">
                        <button class="bg-gray-700 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-600"><i class="fa fa-edit"></i></button>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-cardColor p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-semibold mb-4 text-textColor">Ajouter un Menu</h2>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-400">Nom</label>
                        <input type="text" name="nom" class="w-full bg-gray-700 text-white px-4 py-2 rounded-lg outline-none" required>
                    </div>
                    <div class="flex justify-end gap-4">
                        <button type="button" onclick="document.getElementById('modal').classList.add('hidden')" class="bg-gray-700 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-600">Annuler</button>
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-indigo-600">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
