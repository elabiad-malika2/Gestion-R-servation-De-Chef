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

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises
    $date_reservation = $_POST['date'];
    $heure_reservation = $_POST['time'];
    $nbr_personnes = $_POST['nbrP'];
    $addresse_reservation = $_POST['address'];
    $id_menu = $_POST['menu_id'];
    $id_client = $_POST['user_id'];

    // Préparer la requête SQL pour insérer la réservation
    $sql = "INSERT INTO reservation (date_reservation, heure_reservation, status, id_menu, id_client, addresse_reservation, nbr_personnes)
            VALUES (?, ?, 'En Attente', ?, ?, ?, ?)";

    // Préparer la déclaration
    if ($stmt = $conn->prepare($sql)) {
        // Lier les paramètres
        $stmt->bind_param('ssiisi', $date_reservation, $heure_reservation, $id_menu, $id_client, $addresse_reservation, $nbr_personnes);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Réservation réussie !";
        } else {
            echo "Erreur lors de la réservation.";
        }

        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête.";
    }
}
?>
