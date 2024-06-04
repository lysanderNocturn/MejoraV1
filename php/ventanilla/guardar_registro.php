<?php
// Incluir el archivo de conexión a la base de datos
include('../conection.php');

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $tipoTramite = $_POST['tipoTramite'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $observaciones = $_POST['observaciones'];
    $coordenadas = $_POST['coordenadas'];
    $ubicacion_geologica = $_POST['ubicacion_geologica'];
    $imagen_referencia = $_POST['imagen_referencia'];

    // Calcular la fecha de ingreso
    $fecha_ingreso = date('Y-m-d');

    // Calcular la fecha de entrega estimada usando la función add_business_days
    $fecha_entrega_estimada = date('Y-m-d', strtotime('+10 weekdays', strtotime($fecha_ingreso)));

    // Obtener la conexión a la base de datos
    $conexion = connection();

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO formulario (folio, nombre_propietario, direccion, localidad, tipo_tramite, fecha_ingreso, nombre_solicitante, telefono, correo, usuario_recibe, observaciones, fecha_entrega_estimada, coordenadas, ubicacion_geologica, imagen_referencia) 
            VALUES (folio(), '$nombre', '$direccion', '$localidad', '$tipoTramite', '$fecha_ingreso', '$nombre_solicitante', '$telefono', '$correo', '$usuario', '$observaciones', '$fecha_entrega_estimada', '$coordenadas', '$ubicacion_geologica', '$imagen_referencia')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Alerta de éxito y redirección
        echo "<script>alert('Trámite registrado correctamente.'); window.location.href='ventanilla.php';</script>";
    } else {
        // Alerta de error
        echo "<script>alert('Error al registrar Trámite: " . mysqli_error($conexion) . "');</script>";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>
