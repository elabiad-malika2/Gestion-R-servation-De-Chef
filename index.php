<?php
    include "connection.php";
    
    session_start();
    if(!isset($_SESSION['id_Login']))
    {
        header('Location: login.php');
        exit();
    }
    $userId = $_SESSION['id_Login'];
    echo "user Id" . $userId ;
    

    
    $menu =$conn->query("SELECT * from menu");


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Cuisinier | Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        
        .carousel {
            position: relative;
            overflow: hidden;
        }

        .carousel img {
            transition: transform 0.5s ease-in-out;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            z-index: 10;
        }

        .carousel-btn.left {
            left: 10px;
        }

        .carousel-btn.right {
            right: 10px;
        }
        /* Style des cartes */
        .card {
            background-color: #2d2d2d; 
            color: #c9ab81;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        .card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .card img {
            transition: transform 0.5s ease;
        }

        .card:hover img {
            transform: scale(1.1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
        }

        /* Style des boutons */
        .btn-cta {
            background-color: transparent;
            border: 2px solid #c9ab81;
            color: #c9ab81;
            padding: 10px 20px;
            font-weight: bold;
            
            transition: all 0.3s ease;
        }

        .btn-cta:hover {
            background-color: #c9ab81;
            color: #1a1a1a;
        }
    </style>
</head>
<body>

    <!-- En-tête -->
    <header class="bg-white shadow-md">
        <div class=" mx-auto px-20 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-700">Chef<span class="text-[#c9ab81]">Gourmet</span></h1>
            <nav>
                <ul class="flex gap-8">
                    <li><a href="#" class="hover:text-[#c9ab81]">Accueil</a></li>
                    <li><a href="#" class="hover:text-[#c9ab81]">Menus</a></li>
                    <li><a href="#" class="hover:text-[#c9ab81]">À Propos</a></li>
                    <li><a href="reservationC.php" class="hover:text-[#c9ab81]">Réservation</a></li>
                    <li>
                        <form action="logout.php" method="post">
                            <button><img src="img/logout.png" class="h-4 w-4" alt=""></button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>



    <!-- Section Hero -->
    <section class="h-screen" style="background-image: url('img/heroSection.png'); background-size: cover;">
        <div class="flex items-center flex-col  justify-center h-full bg-black bg-opacity-50">
            <div class="text-center flex flex-col gap-3">
                <h2 class="text-6xl italianno text-[#c9ab81] font-semibold mb-4">Découvrez des saveurs uniques</h2>
                <p class="text-lg text-gray-300 mb-6">Savourez des plats créés avec passion par notre chef cuisinier.</p>
                
            </div>
            <a href="#" class="btn-cta flex items-center justify-center">Voir les Menus</a>
        </div>
    </section>

    <!-- Section Menus -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl font-bold text-center mb-10 text-[#c9ab81]">Nos Menus</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
                                    <div class='carousel-inner'>
                                    "; foreach ($plats as $p) {
                                    
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
                                <button class='bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700' onclick='openModal($menuId)'>
                                    Réserver
                                </button>

                            </div>
                        ";
                    }
                ?>
                
            </div>
        </div>
    </section>
    <!-- Modale (popup) -->
    <div id="reservationModal" class="modal fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="modal-content bg-white p-6 rounded-lg w-1/3">
            <span class="close-btn text-right text-2xl cursor-pointer" onclick="closeModal()">&times;</span>
            <h3 class="text-center text-2xl font-bold text-[#c9ab81]">Réservation</h3>
            
            <!-- Formulaire de réservation -->
            <form action="addR.php" method="POST">
                <input type="hidden" id="menu_id" name="menu_id">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $userId; ?>">

                <div class="flex flex-col gap-4">
                    <label for="date">Date de réservation :</label>
                    <input type="date" id="date" name="date" required class="p-2 border rounded">

                    <label for="time">Heure de réservation :</label>
                    <input type="time" id="time" name="time" required class="p-2 border rounded">

                    <label for="num_people">Nombre de personnes :</label>
                    <input type="number" id="num_people" name="nbrP" min="1" required class="p-2 border rounded">

                    <label for="address">Adresse :</label>
                    <textarea id="address" name="address" required class="p-2 border rounded"></textarea>
                </div>

                <div class="flex justify-end gap-4 mt-4">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Réserver
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Pied de page -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Chef Gourmet. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
