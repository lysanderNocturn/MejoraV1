<?php

include ('../conection.php');
// Assuming you have a database connection established
header('Content-Type: application/json'); // Set the content type to JSON

try {
    // Your database query to fetch locations
    $query = "SELECT * FROM formulario WHERE estatus = 'verificador'";
    $result = $db->query($query);

    $locations = [];
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }

    // Return the JSON-encoded array of locations
    echo json_encode($locations);
} catch (Exception $e) {
    // Handle any exceptions and return an error message
    echo json_encode(['error' => $e->getMessage()]);
}
