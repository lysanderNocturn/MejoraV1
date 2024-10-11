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

// Consultar registros en la tabla formulario
$sql = "SELECT * FROM formulario";
$result = mysqli_query($conexion, $sql);

// Agregar los datos de la tabla al archivo Excel


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
