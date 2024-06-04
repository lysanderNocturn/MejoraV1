<?php
// Incluir PHPExcel
require '../PHPExcel-1.8/Classes/PHPExcel.php';

// Establecer la conexión con la base de datos
include('../conection.php');
$conexion = connection();

// Crear un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer las propiedades del documento
$objPHPExcel->getProperties()->setCreator("Tu nombre")
                             ->setLastModifiedBy("Tu nombre")
                             ->setTitle("Datos de la tabla")
                             ->setSubject("Datos de la tabla")
                             ->setDescription("Datos de la tabla")
                             ->setKeywords("excel php")
                             ->setCategory("Datos");

// Agregar los encabezados de las columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Folio')
            ->setCellValue('B1', 'Nombre del propietario')
            ->setCellValue('C1', 'Dirección')
            ->setCellValue('D1', 'Localidad')
            ->setCellValue('E1', 'Tipo de trámite')
            ->setCellValue('F1', 'Fecha de ingreso')
            ->setCellValue('G1', 'Nombre del solicitante')
            ->setCellValue('H1', 'Teléfono')
            ->setCellValue('I1', 'Correo')
            ->setCellValue('J1', 'Usuario que recibe')
            ->setCellValue('K1', 'Fecha de entrega estimada');

// Consultar registros en la tabla formulario
$sql = "SELECT * FROM formulario";
$result = mysqli_query($conexion, $sql);

// Agregar los datos de la tabla al archivo Excel
$row = 2; // Empezar en la fila 2
while ($mostrar = mysqli_fetch_array($result)) {
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, $mostrar['folio'])
                ->setCellValue('B'.$row, $mostrar['nombre_propietario'])
                ->setCellValue('C'.$row, $mostrar['direccion'])
                ->setCellValue('D'.$row, $mostrar['localidad'])
                ->setCellValue('E'.$row, $mostrar['tipo_tramite'])
                ->setCellValue('F'.$row, $mostrar['fecha_ingreso'])
                ->setCellValue('G'.$row, $mostrar['nombre_solicitante'])
                ->setCellValue('H'.$row, $mostrar['telefono'])
                ->setCellValue('I'.$row, $mostrar['correo'])
                ->setCellValue('J'.$row, $mostrar['usuario_recibe'])
                ->setCellValue('K'.$row, $mostrar['fecha_entrega_estimada']);
    $row++;
}

// Establecer el nombre del archivo
$filename = "datos_tabla.xlsx";

// Configurar encabezados para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

// Crear el escritor de Excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
