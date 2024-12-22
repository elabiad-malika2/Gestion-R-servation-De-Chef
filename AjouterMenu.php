<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajout de menu
    $menuName = $_POST['menuName'];
    $menuPrice = $_POST['menuPrice'];

    $stmMenu = $conn->prepare("INSERT INTO menu (titre, prix) VALUES (?, ?)");
    $stmMenu->bind_param("sd", $menuName, $menuPrice);
    if ($stmMenu->execute()) {
        $menuId = $conn->insert_id;
        // Ajout de plat
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'platTitle_') === 0) {
                $platNombre = str_replace('platTitle_', '', $key);
                $platTitre = $value;
                $platCategorie = $_POST["platCategory_$platNombre"];

                $platImage = null; 
                if (isset($_FILES["platImage_$platNombre"])) {
                    $fileTmpPath = $_FILES["platImage_$platNombre"]["tmp_name"];
                    $fileName = $_FILES["platImage_$platNombre"]["name"];

                    // Définir le répertoire de destination
                    $uploadDir = 'uploads/images/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // Créer un nom unique pour l'image
                    $filePath = $uploadDir . uniqid() . '_' . $fileName;
                    echo "aaaaaaaaa". $filePath;
                    // Déplacer le fichier vers le répertoire
                    if (move_uploaded_file($fileTmpPath, $filePath)) {
                        $platImage = $filePath; // Stocker le chemin de l'image
                    }
                }

                // Ajout de plat
                $stmPlat = $conn->prepare("INSERT INTO plat (titre, categorie, image) VALUES (?, ?, ?)");
                $stmPlat->bind_param("sss", $platTitre, $platCategorie, $platImage);
                if ($stmPlat->execute()) {
                    $platId = $stmPlat->insert_id;
                    $stmAssociation = $conn->prepare("INSERT INTO menuPlat (id_menu, id_plat) VALUES (?, ?)");
                    $stmAssociation->bind_param("ss", $menuId, $platId);
                    $stmAssociation->execute();
                }
            }
        }
        header('Location:DashboardMenu.php');
    }
}
?>
