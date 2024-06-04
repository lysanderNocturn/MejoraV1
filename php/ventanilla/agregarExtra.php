<?php
// Definir la URL a la que se redirigirá después de hacer clic en "Aceptar" en la alerta
$redirectUrl = 'extra.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Incluir archivo de conexión a la base de datos
    include('../conection.php');

    // Obtener los datos del formulario
    $folio = $_POST['folio'];
    $ubicacion = $_POST['ubicacion'];
    $coordenadas = $_POST['coordenadas'];

    // Consulta SQL para actualizar los datos
    $sql = "UPDATE formulario SET ubicacion_geologica = '$ubicacion', coordenadas = '$coordenadas' WHERE folio = $folio";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Los datos se actualizaron correctamente.'); window.location.href = '$redirectUrl';</script>";
    } else {
        throw new Exception("Error al ejecutar la consulta: " . $conn->error);
    }

    // Cerrar la conexión
    $conn->close();
}
?>
