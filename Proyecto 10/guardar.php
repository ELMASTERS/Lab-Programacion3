<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Preparar y ejecutar la consulta de inserción
    $sql = "INSERT INTO usuarios (nombre, apellido, email, telefono) VALUES (:nombre, :apellido, :email, :telefono)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);

    if ($stmt->execute()) {
        echo "Datos guardados exitosamente.";
    } else {
        echo "Error al guardar los datos.";
    }
} else {
    echo "Método no permitido.";
}
?>
