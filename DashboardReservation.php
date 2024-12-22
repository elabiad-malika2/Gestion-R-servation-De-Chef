<?php
include "connection.php";
// session_start();

// if (isset($_SESSION['id_Login'])) {
//     if ($_SESSION['role'] == 'user') {
//         header('Location: index.php');
//         exit();
//     }
// } else {
//     header('Location: login.php');
//     exit();
// }

// Requête pour récupérer les réservations
$sql = "SELECT 
            u.nom AS nom_client,
            r.date_reservation,
            r.heure_reservation,
            r.nbr_personnes,
            r.id as id_reservation
        FROM reservation r
        INNER JOIN user u ON r.id_client = u.id";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5051FA',
                        bgcolor: '#1f2937',
                        cardColor: '#2d3748',
                        textColor: '#c9ab81',
                        btnAccept: '#228B22',
                        btnRefuse: '#FF4500',
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-bgcolor text-textColor min-h-screen">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-52 bg-gray-800 border-r border-gray-700 min-h-full flex flex-col items-center gap-4 py-6">
        <h1 class="text-2xl font-bold text-white">Chef<span class="text-[#c9ab81]">Gourmet</span></h1>
        <nav class="mt-6 space-y-4">
            <a href="#" class="flex gap-4 px-4 py-2 rounded-2xl text-gray-300 hover:bg-gray-700"><i class="fa fa-home"></i> Dashboard</a>
            <a href="#" class="flex gap-4 px-4 py-2 rounded-2xl text-gray-300 hover:bg-gray-700"><i class="fa fa-calendar-check"></i> Réservations</a>
            <a href="#" class="flex gap-4 px-4 py-2 rounded-2xl text-gray-300 hover:bg-gray-700"><i class="fa fa-chart-bar"></i> Statistiques</a>
        </nav>
    </aside>
    <!-- Main Content -->
    <div class="flex-1">
        <!-- Header -->
        <header class="h-20 bg-gray-900 border-b border-gray-700 flex items-center px-8">
            <div class="flex items-center gap-2">
                <input class="bg-gray-700 text-white placeholder-gray-400 w-64 px-4 py-2 rounded-lg outline-none" type="search" placeholder="Rechercher une réservation">
                <button class="bg-[#c9ab81] text-white px-4 py-2 rounded-lg hover:bg-indigo-600"><i class="fa fa-search"></i></button>
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
                <h1 class="text-xl font-semibold">Réservations</h1>
            </div>
            <div class="bg-cardColor p-6 rounded-lg shadow-lg">
                <table class="w-full text-left border-collapse border border-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-gray-300">Nom du Client</th>
                            <th class="px-4 py-2 text-gray-300">Date</th>
                            <th class="px-4 py-2 text-gray-300">Heure</th>
                            <th class="px-4 py-2 text-gray-300">Nombre de personnes</th>
                            <th class="px-4 py-2 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="border-b border-gray-700">
                                    <td class="px-4 py-2 text-gray-400"><?= htmlspecialchars($row['nom_client']); ?></td>
                                    <td class="px-4 py-2 text-gray-400"><?= htmlspecialchars($row['date_reservation']); ?></td>
                                    <td class="px-4 py-2 text-gray-400"><?= htmlspecialchars($row['heure_reservation']); ?></td>
                                    <td class="px-4 py-2 text-gray-400"><?= htmlspecialchars($row['nbr_personnes']); ?></td>
                                    <td class="px-3 py-2 flex gap-4">
                                        <button class="text-white text-xs px-4 py-2 rounded-lg border hover:border-transparent hover:bg-btnAccept bg-transparent border-green-700">
                                            <i class="fa fa-check text-xs"></i> Accepter
                                        </button>
                                        <button class="text-white text-xs px-4 py-2 rounded-lg border hover:bg-btnRefuse bg-transparent hover:border-transparent border-red-700">
                                            <i class="fa fa-times text-xs"></i> Refuser
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-400">Aucune réservation trouvée.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
</body>
</html>
