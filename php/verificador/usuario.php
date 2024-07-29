<?php
include('../conection.php');

// Iniciar sesión y verificar si el usuario está logueado
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../../index.php"); // Redirigir si no está logueado
    exit();
}

// Obtener el nombre de usuario de la sesión
$username = $_SESSION["username"];

// Obtener conexión
$conn = connection();

// Consulta SQL
$sql = "SELECT * FROM `formulario` WHERE estatus = 'verificador' ORDER BY `folio` DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>



