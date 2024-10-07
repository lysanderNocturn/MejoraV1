<?php
include('../conection.php');  // Asegúrate de que la ruta sea correcta y que $mysqli esté correctamente definido

$folio = $_POST['folio'];
$comentarios = $_POST['comentarios'];
$numeroDireccion = $_POST['numeroDireccion'];
$lote = $_POST['lote'];
$manzana = $_POST['manzana'];
$estatus = 'ventanilla';
$target_file = null;  // Inicializamos la variable para la imagen

// Verificar si se ha subido una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $target_directory = "../../$folio/";
    $target_file = $target_directory . basename($_FILES['imagen']['name']);
    
    // Verificar que el directorio de destino exista
    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0755, true); // Crear el directorio si no existe
    }

    // Mover el archivo subido al directorio destino
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        echo "Imagen subida correctamente.<br />";
    } else {
        echo "Error al subir la imagen.<br />";
    }
}

// Actualizar los datos en la base de datos según el folio
if ($mysqli) {
    // Si se subió una imagen, la incluimos en la actualización, de lo contrario, omitimos la columna
    if ($target_file) {
        $sql = "UPDATE formulario SET comentarios = ?, numeroDireccion = ?, lote = ?, manzana = ?, imagen = ?, estatus = ? WHERE folio = ?";
    } else {
        $sql = "UPDATE formulario SET comentarios = ?, numeroDireccion = ?, lote = ?, manzana = ?, estatus = ? WHERE folio = ?";
    }

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        if ($target_file) {
            $stmt->bind_param('sssssss', $comentarios, $numeroDireccion, $lote, $manzana, $target_file, $estatus, $folio);
        } else {
            $stmt->bind_param('ssssss', $comentarios, $numeroDireccion, $lote, $manzana, $estatus, $folio);
        }

        if ($stmt->execute()) {
            echo "Datos actualizados correctamente.<br />";
        } else {
            echo "Error al actualizar los datos.<br />";
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta SQL.<br />";
    }
} else {
    echo "Error: No se pudo conectar a la base de datos.<br />";
}
?>
