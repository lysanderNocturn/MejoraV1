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
    $sql = "UPDATE formulario SET ubicacion = '$ubicacion', estatus = 'verificador' WHERE folio = '$folio'";



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

<?php
// Verificar si se ha seleccionado un folio
if(isset($_POST['folio'])) {
    // Obtener el folio seleccionado
    $folio = $_POST['folio'];
    
    // Directorio donde se guardarán los archivos
    $directorio = "archivos/$folio/";

    // Verificar si el directorio ya existe
    if (!file_exists($directorio)) {
        // Si no existe, crear el directorio
        mkdir($directorio, 0777, true);
    }

    // Mover los archivos cargados a la carpeta correspondiente
    if(move_uploaded_file($_FILES['escrituras']['tmp_name'], $directorio . $_FILES['escrituras']['name']) &&
        move_uploaded_file($_FILES['boleta-predial']['tmp_name'], $directorio . $_FILES['boleta-predial']['name']) &&
        move_uploaded_file($_FILES['identificacion']['tmp_name'], $directorio . $_FILES['identificacion']['name'])) {
        // Archivos subidos con éxito
        echo "Archivos subidos con éxito.";
    } else {
        // Error al subir los archivos
        echo "Error al subir los archivos.";
    }
} else {
    // No se ha seleccionado un folio
    echo "No se ha seleccionado un folio.";
}
?>
