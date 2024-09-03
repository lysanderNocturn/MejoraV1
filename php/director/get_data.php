<?php
// Conexión a la base de datos
include 'conection.php';

// Asegúrate de que la conexión esté abierta
if ($conn) {
    // Obtener el tipo de trámite de la petición
    $tipo_tramite = $_GET['tipo_tramite'];

    // Consultar la base de datos
    $query = "SELECT * FROM formulario WHERE tipo_tramite = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tipo_tramite);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    // No cierres la conexión aquí si la vas a usar más tarde
    // $conn->close();

    // Retornar los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    die("Error en la conexión: " . mysqli_connect_error());
}
?>
