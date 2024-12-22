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
        r.id,
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
                            <button
                            class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition" 
                            onclick="openEditModal(
                                '<?= htmlspecialchars($row['id']); ?>', 
                                '<?= htmlspecialchars($row['date_reservation']); ?>', 
                                '<?= htmlspecialchars($row['heure_reservation']); ?>', 
                                '<?= htmlspecialchars($row['nbr_personnes']); ?>', 
                                '<?= htmlspecialchars($row['addresse_reservation']); ?>'
                            )">
                            Modifier
                            </button>
                             <!-- Bouton Annuler -->
                              <form action="update_Status.php" method="post">
                              <input type="hidden" name="reservation_idU" id="reservation_idU" value="<?= htmlspecialchars($row['id']); ?>">
                              <button  class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition" >Annuler</button>
                              </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-lg text-gray-600">Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-xl font-semibold mb-4">Modifier Réservation</h2>
            <form id="editForm" action="update_reservation.php" method="POST">
                <input type="hidden" name="reservation_id" id="reservation_id">
            
                <div class="mb-4">
                    <label for="date_reservation" class="block font-medium">Date:</label>
                    <input type="date" name="date_reservation" id="date_reservation" class="w-full border rounded-lg p-2">
                </div>
                <div class="mb-4">
                    <label for="heure_reservation" class="block font-medium">Heure:</label>
                    <input type="time" name="heure_reservation" id="heure_reservation" class="w-full border rounded-lg p-2">
                </div>
                <div class="mb-4">
                    <label for="nbr_personnes" class="block font-medium">Nombre de personnes:</label>
                    <input type="number" name="nbr_personnes" id="nbr_personnes" class="w-full border rounded-lg p-2">
                </div>
                <div class="mb-4">
                    <label for="addresse_reservation" class="block font-medium">Adresse:</label>
                    <input type="text" name="addresse_reservation" id="addresse_reservation" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openEditModal(id, dateReservation, heureReservation, nbrPersonnes, addresseReservation) {
            // Populate modal fields
            document.getElementById("reservation_id").value = id;
            document.getElementById("date_reservation").value = dateReservation;
            document.getElementById("heure_reservation").value = heureReservation;
            document.getElementById("nbr_personnes").value = nbrPersonnes;
            document.getElementById("addresse_reservation").value = addresseReservation;

            // Show the modal
            document.getElementById("editModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("editModal").classList.add("hidden");
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("editModal").addEventListener("click", (event) => {
                if (event.target === document.getElementById("editModal")) {
                    closeModal();
                }
            });
        });
    </script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</body>
</html>