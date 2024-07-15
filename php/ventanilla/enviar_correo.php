<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario y sanitiza las entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $nombre_solicitante = htmlspecialchars(trim($_POST['nombre_solicitante']));
    $direccion = htmlspecialchars(trim($_POST['direccion']));
    $localidad = htmlspecialchars(trim($_POST['localidad']));
    $tipoTramite = htmlspecialchars(trim($_POST['tipoTramite']));
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $usuario = htmlspecialchars(trim($_POST['usuario']));
    $observaciones = htmlspecialchars(trim($_POST['observaciones']));

    // Validar los datos
    $errors = [];
    if (empty($nombre)) {
        $errors[] = "El nombre del propietario es obligatorio.";
    }
    if (empty($nombre_solicitante)) {
        $errors[] = "El nombre del solicitante es obligatorio.";
    }
    if (empty($direccion)) {
        $errors[] = "La dirección es obligatoria.";
    }
    if (empty($localidad)) {
        $errors[] = "La localidad es obligatoria.";
    }
    if (empty($tipoTramite)) {
        $errors[] = "El tipo de trámite es obligatorio.";
    }
    if (!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Correo electrónico no válido.";
    }
    if (empty($telefono)) {
        $errors[] = "El teléfono es obligatorio.";
    }
    if (empty($observaciones)) {
        $errors[] = "Las observaciones son obligatorias.";
    }

    // Si hay errores, mostrar mensajes de error
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }

    // Configura los detalles del correo
    $destinatario = "phrd.123@gmail.com";  // Reemplaza con tu dirección de correo
    $asunto = "Nuevo registro de actividad";
    $cuerpo = "Nombre del propietario: $nombre\nNombre del solicitante: $nombre_solicitante\nDirección: $direccion\nLocalidad: $localidad\nTipo de trámite: $tipoTramite\nCorreo: $correo\nTeléfono: $telefono\nRecibió: $usuario\nObservaciones:\n$observaciones";
    $headers = "From: $correo\r\n";

    // Envía el correo
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        echo "Correo enviado exitosamente.";
    } else {
        echo "Hubo un problema al enviar el correo.";
    }
} else {
    echo "Método de solicitud no soportado.";
}
?>
