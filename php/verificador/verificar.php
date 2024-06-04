<?php
    // Incluir el archivo de conexión a la base de datos
    include('../conection.php');

    // Obtener los datos del formulario
    $folio = $_POST['folio'];
    $coordenadas = $_POST['coordenadas'];
    $ubicacion_geologica = $_POST['ubicacion_geologica'];
    
    // Establecer conexión a la base de datos
    $conexion = connection();
    
    // Construir la consulta SQL para actualizar la tabla tramites
    $sql = "UPDATE formulario SET coordenadas='$coordenadas', ubicacion_geologica='$ubicacion_geologica' WHERE folio='$folio'";
    
    // Ejecutar la consulta
    $result = mysqli_query($conexion, $sql);
    
    // Verificar si la actualización fue exitosa
    if ($result) {
        // Éxito: Mostrar un mensaje de éxito en una alerta y redirigir
        echo "<script>alert('Los datos se han actualizado correctamente.'); window.location.href='verificador.php';</script>";
    } else {
        // Error: Mostrar un mensaje de error en una alerta
        echo "<script>alert('Ha ocurrido un error al intentar actualizar los datos.');</script>";
    }

    // Cerrar la conexión
    mysqli_close($conexion);
?>
