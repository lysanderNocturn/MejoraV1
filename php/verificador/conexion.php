<?php
$host = "localhost"; // Cambia esto si usas otro servidor
$user = "root";
$password = "";
$database = "planeacion";

// Crear la conexión
$mysqli_connection = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($mysqli_connection->connect_error) {
    die("Error de conexión: " . $mysqli_connection->connect_error);
}
?>
