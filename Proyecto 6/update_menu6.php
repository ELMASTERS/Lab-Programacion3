<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents('php://input');
    error_log("Received data: " . $data); // Agregar esto para depuración

    if (!empty($data)) {
        $json_data = json_decode($data, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            if (file_put_contents('menu.json', json_encode($json_data, JSON_PRETTY_PRINT))) {
                echo json_encode(['status' => 'success', 'message' => 'Menu updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to write to menu.json']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data to save']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
