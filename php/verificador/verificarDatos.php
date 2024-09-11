<?php
include('../conection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folio = $_POST['folio'];
    $comentarios = $_POST['comentarios'];
    $lote = $_POST['lote'];
    $manzana = $_POST['manzana'];
    $numeroDireccion = $_POST['numeroDireccion'];
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    // Validate file type (optional, for security)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    
    if (in_array($imageFileType, $allowed_types)) {
        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            $conn = connection();
            $sql = "INSERT INTO observaciones (folio, comentarios, imagen, lote, manzana, numeroDireccion) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssss", $folio, $comentarios, $imagen, $lote, $manzana, $numeroDireccion);

            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "error";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "error uploading file";
        }
    } else {
        echo "invalid file type";
    }
}
?>
