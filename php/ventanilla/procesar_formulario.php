<?php
// Incluir el archivo de conexión a la base de datos
include('../conection.php');

// Función para calcular días hábiles
function add_business_days($start_date, $days) {
    $current_date = strtotime($start_date);
    $i = 0;

    while ($i < $days) {
        $current_date = strtotime("+1 day", $current_date);
        // Si es lunes (1) a viernes (5), cuenta como día hábil
        if (date('N', $current_date) <= 5) {
            $i++;
        }
    }
    
    return date('d-m-Y', $current_date);
}

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

    // Calcular la fecha de ingreso (hoy)
    $fecha_ingreso = date('d-m-Y');

    // Calcular la fecha de entrega estimada agregando 10 días hábiles
    $fecha_entrega_estimada = add_business_days($fecha_ingreso, 10);

    // Obtener la conexión a la base de datos
    $conexion = connection();

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO formulario (folio, nombre_propietario, direccion, localidad, tipo_tramite, fecha_ingreso, nombre_solicitante, telefono, correo, usuario_recibe, observaciones, fecha_entrega_estimada, estatus) 
            VALUES (folio(), '$nombre', '$direccion', '$localidad', '$tipoTramite', '$fecha_ingreso', '$nombre_solicitante', '$telefono', '$correo', '$usuario', '$observaciones', '$fecha_entrega_estimada', 'ventanilla')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Alerta de éxito y redirección
        echo "<script>alert('Tramite registrado correctamente.'); window.location.href='extra.php';</script>";
    } else {
        // Alerta de error
        echo "<script>alert('Error al registrar Tramite: " . mysqli_error($conexion) . "');</script>";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>
