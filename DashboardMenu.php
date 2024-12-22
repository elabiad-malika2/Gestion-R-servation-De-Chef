<?php
    include "connection.php";
    session_start();
    if(isset($_SESSION['id_Login']))
    {
        if($_SESSION['role'] == 'user'){
            header('Location: index.php');
        }else if ($_SESSION['role'] == 'admin') {
            header('Location: DashboardMenu.php');
        }
        } else {
            header('Location: login.php');
        }
    
    $menu =$conn->query("SELECT * from menu");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="menu.css">
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
                <form action="logout.php" method="post">
                        <button><img src="img/logout.png" class="h-4 w-4" alt=""></button>
                </form>
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
                <button id="add-etd" onclick="toggleModal()" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-indigo-600">
                    <i class="fa fa-plus-circle"></i> Ajouter Menu
                </button>
            </div>
            <div class="grid grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                    foreach ($menu as $m) {
                        $menuId=$m['id'];
                        $menuTitre=$m['titre'];
                        $menuPrix=$m['prix'];
                        $plats = $conn->query("SELECT * 
                            FROM plat 
                            WHERE id IN (
                                SELECT id_plat 
                                FROM menuplat 
                                WHERE id_menu = $menuId
                            );
                        ");
                        echo   "
                            <div class=' bg-gray-800 rounded-lg shadow-lg overflow-hidden'>
                                <div class='carousel h-48'>
                                    <div class='carousel-inner'>"; 
                                    foreach ($plats as $p) {
                                        echo"<img src='".$p['image']."' alt='Plat 1' class='w-full flex-shrink-0'>";
                                    }
                                    echo"
                                    </div>
                                    <button class='carousel-btn left'>&lt;</button>
                                    <button class='carousel-btn right'>&gt;</button>
                                </div>
                                <div class='p-6'>
                                    <h4 class='font-bold text-xl mb-2 text-[#c9ab81]'>$menuTitre</h4>
                                    <p class='text-gray-400'>Prix : $menuPrix</p>
                                </div>
                                <div class='flex justify-end gap-4'>
                                    <button class='bg-gray-700 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-600'><i class='fa fa-edit'></i></button>
                                    <button class='bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700'><i class='fa fa-trash'></i></button>
                                </div>
                            </div>
                        ";
                    }
                ?>
                
            </div>
        </section>
        <!-- Modal -->
        <div id="menuModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center  justify-center z-50">
    <div class="bg-cardColor w-full max-w-lg p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-white mb-4">Créer un Menu</h2>
        <form id="menuForm" action="AjouterMenu.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <!-- Infos Menu -->
            <div>
                <label for="menuName" class="block text-gray-300 mb-1">Nom du Menu</label>
                <input type="text" id="menuName" name="menuName" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white outline-none" placeholder="Entrez le nom du menu">
            </div>
            <div>
                <label for="menuPrice" class="block text-gray-300 mb-1">Prix du Menu (€)</label>
                <input type="number" id="menuPrice" name="menuPrice" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white outline-none" placeholder="Entrez le prix du menu">
            </div>

            <!-- Section Plats -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-2">Plats</h3>
                <div id="dishesContainer" class="space-y-4">
                    <!-- Les plats seront ajoutés dynamiquement ici -->
                </div>
                <button type="button" onclick="addDish()" class="bg-btnAdd text-white px-4 py-2 rounded-lg hover:bg-green-700 mt-2">
                    Ajouter un Plat
                </button>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end gap-4 mt-4">
                <button type="button" onclick="toggleModal()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Annuler</button>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-indigo-600">Enregistrer</button>
            </div>
        </form>
    </div>
</div>


    </div>
</div>
    <!-- Script JS -->
    <script>
        const menuModal = document.getElementById('menuModal');
        const dishesContainer = document.getElementById('dishesContainer');

        // Fonction pour afficher ou masquer le modal
        function toggleModal() {
            menuModal.classList.toggle('hidden');
        }

        let cmp = 0; 
        function addDish() {
            cmp++;
            const dishDiv = document.createElement('div');
            dishDiv.className = 'flex gap-4 items-center';
            dishDiv.innerHTML = `
                <input type="text"  name="platTitle_${cmp}"  placeholder="Nom du plat" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white outline-none" required>
                <input type="text" name="platCategory_${cmp}" placeholder="Catégorie" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white outline-none" required>
                <input type="file" name="platImage_${cmp}" placeholder="Image" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white outline-none" required>
                <button type="button" onclick="removeDish(this)" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-700">Supprimer</button>
            `;
            dishesContainer.appendChild(dishDiv);
        }

        function removeDish(button) {
            button.parentElement.remove();
        }

        //  Carroussel
        document.querySelectorAll('.carousel').forEach(carousel => {
        const inner = carousel.querySelector('.carousel-inner');
        const leftBtn = carousel.querySelector('.carousel-btn.left');
        const rightBtn = carousel.querySelector('.carousel-btn.right');
        let index = 0;

        // Fonction pour mettre à jour le défilement
        function updateCarousel() {
            const offset = -index * 100;
            inner.style.transform = `translateX(${offset}%)`;
        }

        // Bouton gauche
        leftBtn.addEventListener('click', () => {
            index = (index > 0) ? index - 1 : inner.children.length - 1;
            updateCarousel();
        });

        // Bouton droit
        rightBtn.addEventListener('click', () => {
            index = (index < inner.children.length - 1) ? index + 1 : 0;
            updateCarousel();
        });
    });
        const cards = document.querySelectorAll('.card');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                }
            });
        });

        cards.forEach(card => {
            observer.observe(card);
        });


    </script>
</body>
</html>
