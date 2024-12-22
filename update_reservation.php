<?php
include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $nom_menu = $_POST['nom_menu'];
    $date_reservation = $_POST['date_reservation'];
    $heure_reservation = $_POST['heure_reservation'];
    $nbr_personnes = $_POST['nbr_personnes'];
    $addresse_reservation = $_POST['addresse_reservation'];

    $reservation_id = intval($reservation_id);
    $nom_menu = htmlspecialchars($nom_menu);
    $date_reservation = htmlspecialchars($date_reservation);
    $heure_reservation = htmlspecialchars($heure_reservation);
    $nbr_personnes = intval($nbr_personnes);
    $addresse_reservation = htmlspecialchars($addresse_reservation);

    $sql = "UPDATE reservation 
            SET 
                date_reservation = ?, 
                heure_reservation = ?, 
                nbr_personnes = ?, 
                addresse_reservation = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $date_reservation, $heure_reservation, $nbr_personnes, $addresse_reservation, $reservation_id);

        if ($stmt->execute()) {
            header("Location: reservationC.php");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erreur : " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: index.php");
    exit();
}


?>