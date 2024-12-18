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
                    <li><a href="#" class="hover:text-[#c9ab81]">Réservation</a></li>
                </ul>
            </nav>
        </div>
    </header>



    <!-- Section Hero -->
    <section class="h-screen" style="background-image: url('heroSection.png'); background-size: cover;">
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
                <!-- Carte 1 -->
                <div class="card bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="carousel h-48">
                    <div class="carousel-inner">
                        <img src="heroChef.jpg" alt="Plat 1" class="w-full flex-shrink-0">
                        <img src="heroRES.jpg" alt="Plat 2" class="w-full flex-shrink-0">
                        <img src="heroSection.png" alt="Plat 3" class="w-full flex-shrink-0">
                    </div>
                    <button class="carousel-btn left">&lt;</button>
                    <button class="carousel-btn right">&gt;</button>
                </div>
                <div class="p-6">
                    <h4 class="font-bold text-xl mb-2 text-[#c9ab81]">Plat Signature</h4>
                    <p class="text-gray-400">Un plat préparé avec des ingrédients de qualité pour un goût exceptionnel.</p>
                </div>
            </div>

                <!-- Carte 2 -->
                <div class="card rounded-lg shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x300/?pasta" alt="Pâtes" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-bold text-xl mb-2">Pâtes Gourmandes</h4>
                        <p class="text-gray-400">Des pâtes fraîches faites maison avec une sauce crémeuse délicieuse.</p>
                    </div>
                </div>
                <!-- Carte 3 -->
                <div class="card rounded-lg shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x300/?dessert" alt="Dessert" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-bold text-xl mb-2">Dessert Royal</h4>
                        <p class="text-gray-400">Une touche sucrée pour terminer votre repas en beauté.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Chef Gourmet. Tous droits réservés.</p>
        </div>
    </footer>

    <script>

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
