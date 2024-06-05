<?php
// Verificar si se han recibido datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include ('../conection.php');

    // Recoger los datos del formulario
    $folio = $_POST['folio'];
    $ubicacion = $_POST['ubicacion'];
    // Aquí puedes manejar la imagen si necesitas guardarla en la base de datos o en el servidor.

    // Preparar la consulta SQL para actualizar la base de datos
    $sql = "UPDATE formulario SET ubicacion = '$ubicacion' WHERE folio = '$folio'";

    // Obtener una conexión nueva
    $conn = connection();

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Éxito al actualizar la base de datos
        echo "Los datos se actualizaron correctamente.";
    } else {
        // Error al actualizar la base de datos
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
