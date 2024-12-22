<?php
include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_idU'];
    $status = 'Annulée';

    $sql = "UPDATE reservation set status = ? where id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss",$status, $reservation_id);

        if ($stmt->execute()) {
            // 
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