<?php
include('conection.php'); // Incluye el archivo de conexión

$sql = "SELECT nombre_propietario, direccion, ubicacion, estatus FROM formulario WHERE ubicacion IS NOT NULL";
$result = $conn->query($sql);

$locations = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = array(
            'nombre_propietario' => $row['nombre_propietario'],
            'direccion' => $row['direccion'],
            'ubicacion' => $row['ubicacion'], // Coordenadas UTM en formato "easting, northing"
            'estatus' => $row['estatus']
        );
    }
}

echo json_encode($locations);

$conn->close();
?>
