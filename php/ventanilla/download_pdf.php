<?php
// Incluir FPDF
require_once '../../fpdf/fpdf.php';

// Incluir FPDI
require_once '../../fpdi/src/autoload.php';

use setasign\Fpdi\Fpdi;

// Verificar que se ha enviado un folio válido
if (!isset($_GET['folio'])) {
    die('Folio no especificado.');
}

$folio = $_GET['folio'];

// Crear instancia de FPDI
$pdf = new FPDI();

// Ruta al archivo PDF existente
$archivo_pdf = '../../FORMATO.pdf';

// Cargar el archivo PDF existente
$pdf->setSourceFile($archivo_pdf);

// Importar la primera página del PDF
$tplId = $pdf->importPage(1);
$pdf->AddPage();
$pdf->useTemplate($tplId);

// Configurar la fuente
$pdf->SetFont('Arial', '', 12);

// Conectar a la base de datos
include('../conection.php');
$conexion = connection();
$sql = "SELECT * FROM formulario WHERE folio = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('s', $folio);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Verificar si se encontró el registro
if ($data) {
    // Escribir datos en el PDF
    $pdf->SetXY(174, 21); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['folio']);

    $pdf->SetXY(52, 40);
    $pdf->Write(0, $data['nombre_propietario']);
    
    $pdf->SetXY(33, 49); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['direccion']);

    $pdf->SetXY(33, 57); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['localidad']);

    $pdf->SetXY(105, 57); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['ubicacion']);

    $pdf->SetXY(28, 72); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['tipo_tramite']);

    $pdf->SetXY(57, 82); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['fecha_ingreso']);

    $pdf->SetXY(52, 93); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['nombre_solicitante']);

    $pdf->SetXY(33, 102); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['telefono']);

    $pdf->SetXY(45, 110); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['correo']);

    $pdf->SetXY(28, 120); // Cambia las coordenadas según la ubicación del campo
    $pdf->Write(0, $data['usuario_recibe']);
    
    // Añadir más campos según sea necesario...

} else {
    die('Registro no encontrado.');
}

// Cerrar la conexión
mysqli_close($conexion);

// Guardar el archivo PDF modificado
$pdf->Output('D', 'registro_actividades_' . $folio . '.pdf'); // El primer parámetro es el modo de salida, 'D' para descargar
?>
