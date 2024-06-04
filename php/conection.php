<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'planeacion');

// Function to establish database connection
function connection(){
    $mysqli_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check if connection was successful
    if ($mysqli_connection->connect_errno) {
        echo "Error de conexion con la base de datos: " . $mysqli_connection->connect_errno;
        exit;
    }

    return $mysqli_connection;
}

// Obtener los folios registrados
$conn = connection();
$sql = "SELECT folio FROM formulario";
$result = $conn->query($sql);
$conn->close();
?>
