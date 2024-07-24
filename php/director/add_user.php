<?php
include('../conection.php');

// Obtener la conexión
$conn = connection();

// Verificar si la conexión fue exitosa
if ($conn === false) {
    die("ERROR: No se pudo conectar a la base de datos.");
}

// Obtener los datos del formulario
$name = mysqli_real_escape_string($conn, $_POST['name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$level = (int)$_POST['level'];

// Insertar el nuevo usuario en la base de datos
$query = "INSERT INTO usuarios (nombre, usuario, password, nivel) VALUES ('$name', '$username', '$password', $level)";

if (mysqli_query($conn, $query)) {
    echo "Usuario agregado exitosamente.";
} else {
    echo "Error al agregar usuario: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
