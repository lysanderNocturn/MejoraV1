<?php
include('../conection.php');  // Asegúrate de que la ruta sea correcta

$folio = $_POST['folio'];
$comentarios = $_POST['comentarios'];
$numeroDireccion = $_POST['numeroDireccion'];
$lote = $_POST['lote'];
$manzana = $_POST['manzana'];

// Verificar si se ha subido una imagen
if (isset($_FILES['imagen'])) {
    $target_directory = '../../uploads/';
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
if ($mysqli) {  // Verificar si la conexión existe
    $sql = "UPDATE formulario SET comentarios = ?, numeroDireccion = ?, lote = ?, manzana = ?, imagen = ? WHERE folio = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('sssssi', $comentarios, $numeroDireccion, $lote, $manzana, $target_file, $folio);
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

// Cerrar la conexión MySQL
if ($mysqli) {
    $mysqli->close();
}
?>


<?php
// Verificar si se han recibido datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include ('../conection.php');

    // Recoger los datos del formulario
    $folio = $_POST['folio'];
    $ubicacion = $_POST['ubicacion'];

    // Directorio donde se guardarán los archivos
    $directorio = "archivos/$folio/";

    // Verificar si el directorio ya existe
    if (!file_exists($directorio)) {
        // Si no existe, crear el directorio
        mkdir($directorio, 0777, true);
    }

    // Manejar la subida de archivos
    $escriturasPath = $directorio . basename($_FILES['escrituras']['name']);
    $boletaPredialPath = $directorio . basename($_FILES['boleta-predial']['name']);
    $identificacionPath = $directorio . basename($_FILES['identificacion']['name']);

    if (move_uploaded_file($_FILES['escrituras']['tmp_name'], $escriturasPath) &&
        move_uploaded_file($_FILES['boleta-predial']['tmp_name'], $boletaPredialPath) &&
        move_uploaded_file($_FILES['identificacion']['tmp_name'], $identificacionPath)) {
        // Archivos subidos con éxito

        // Preparar la consulta SQL para actualizar la base de datos
        $sql = "UPDATE formulario SET ubicacion = '$ubicacion', estatus = 'verificador', 
                escrituras = '$escriturasPath', boleta_predial = '$boletaPredialPath', 
                identificacion = '$identificacionPath' WHERE folio = '$folio'";

        // Obtener una conexión nueva
        $conn = connection();

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Éxito al actualizar la base de datos
            // Redirigir a la descarga del PDF
            header("Location: download_pdf.php?folio=$folio");
            exit(); // Importante: Termina la ejecución después de redirigir
        } else {
            // Error al actualizar la base de datos
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    } else {
        // Error al subir los archivos
        echo "Error al subir los archivos.";
    }
} else {
    // No se ha seleccionado un folio
    echo "No se ha seleccionado un folio.";
}
?>

