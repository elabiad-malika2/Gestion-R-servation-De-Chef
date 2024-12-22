<?php
// Inclure la connexion à la base de données
include "./connection.php";

// Démarrer la session pour récupérer l'ID de l'utilisateur connecté
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_Login'])) {
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$id_client = $_SESSION['id_Login'];

// Requête SQL avec sous-requête
$sql = "SELECT 
        r.date_reservation,
        r.heure_reservation,
        r.nbr_personnes,
        r.addresse_reservation,
        r.status,
        (SELECT m.titre FROM menu m WHERE m.id = r.id_menu) AS nom_menu
    FROM 
        reservation r
    WHERE 
        r.id_client = ?;
";

// Préparer et exécuter la requête
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_client);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto my-8 p-4">
        <h1 class="text-4xl font-bold text-center mb-8">Mes Réservations</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col">
                        <h3 class="text-xl font-semibold text-center text-gray-800 mb-2"><?= htmlspecialchars($row['nom_menu']); ?></h3>
                        <p class="text-gray-600 mb-2"><strong>Date:</strong> <?= htmlspecialchars($row['date_reservation']); ?></p>
                        <p class="text-gray-600 mb-2"><strong>Heure:</strong> <?= htmlspecialchars($row['heure_reservation']); ?></p>
                        <p class="text-gray-600 mb-2"><strong>Nombre de personnes:</strong> <?= htmlspecialchars($row['nbr_personnes']); ?></p>
                        <p class="text-gray-600 mb-4"><strong>Adresse:</strong> <?= htmlspecialchars($row['addresse_reservation']); ?></p>

                        <div class="mb-4">
                            <strong>Status:</strong> 
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                <?= $row['status'] === 'En Attente' ? 'bg-yellow-400 text-gray-800' : ($row['status'] === 'Confirmée' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'); ?>">
                                <?= htmlspecialchars($row['status']); ?>
                            </span>
                        </div>

                        <div class="flex justify-between mt-auto">
                            <!-- Bouton Modifier -->
                            <a href="" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">Modifier</a>
                            <!-- Bouton Annuler -->
                            <a href="" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition" >Annuler</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-lg text-gray-600">Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>
</body>
</html>
