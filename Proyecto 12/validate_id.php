<?php
// Definimos el cabezal para aceptar solicitudes AJAX
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// Función para validar la cédula utilizando el Módulo 10
function validateCedula($cedula) {
    // El formato de la cédula debe ser un número de 11 dígitos
    if (strlen($cedula) != 11 || !is_numeric($cedula)) {
        return false;  // Si la cédula no tiene 11 dígitos, es inválida
    }

    // Multiplicar los dígitos de la cédula por un peso específico
    $peso = [1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1];
    $suma = 0;
    
    // Sumamos el resultado de la multiplicación de cada dígito por su peso
    for ($i = 0; $i < 11; $i++) {
        $producto = (int)$cedula[$i] * $peso[$i];
        $suma += ($producto > 9) ? $producto - 9 : $producto;  // Si el producto es mayor a 9, restamos 9
    }

    // Verificamos que la suma sea múltiplo de 10 (módulo 10)
    return $suma % 10 === 0;
}

// Capturamos el cuerpo de la solicitud (JSON)
$data = json_decode(file_get_contents("php://input"));

// Verificamos si se ha enviado una cédula
if (isset($data->cedula)) {
    $cedula = $data->cedula;

    // Validamos la cédula
    if (validateCedula($cedula)) {
        echo json_encode(["valid" => true, "message" => "Cédula válida"]);
    } else {
        echo json_encode(["valid" => false, "message" => "Cédula inválida"]);
    }
} else {
    echo json_encode(["valid" => false, "message" => "No se proporcionó una cédula"]);
}
?>
