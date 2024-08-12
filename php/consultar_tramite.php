<?php
include 'conection.php';

// Obtén los datos de la solicitud POST
$input = json_decode(file_get_contents('php://input'), true);

// Verifica si 'folio' está definido en la solicitud
if (!isset($input['folio'])) {
    echo json_encode(['success' => false, 'message' => 'Folio no proporcionado']);
    exit;
}

$folio = $input['folio'];
$conn = connection();

// Prepara y ejecuta la consulta
$sql = "SELECT * FROM formulario WHERE folio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $folio);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tramite = $result->fetch_assoc();
    echo json_encode(['success' => true, 'tramite' => $tramite]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontró el trámite']);
}

$stmt->close();
$conn->close();
?>
