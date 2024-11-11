<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Respond to preflight request
    exit(0);
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $filename = 'data.json';
    if (file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT))) {
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Unable to save data']);
    }
} else {
    echo json_encode(['error' => 'Invalid data']);
}
?>