<?php
include('../conection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folio = $_POST['folio'];
    $comentarios = $_POST['comentarios'];
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    // Mover la imagen subida al directorio de destino
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        $conn = connection();
        $sql = "INSERT INTO observaciones (folio, comentarios, imagen) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $folio, $comentarios, $imagen);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "error";
    }
}
?>
