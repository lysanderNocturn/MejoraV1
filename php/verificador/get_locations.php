<?php
include('connection.php');

// Conexión a la base de datos
$conn = connection();

// Consulta para obtener los datos
$sql = "SELECT nombre_propietario, direccion, coordenadas, estatus FROM formulario";
$result = $conn->query($sql);

$locations = [];

if ($result->num_rows > 0) {
    // Recorrer resultados
    while($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}

$conn->close();

// Devolver resultados en formato JSON
echo json_encode($locations);
?>
