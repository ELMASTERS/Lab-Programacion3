<?php
require 'db.php';

$sql = "SELECT nombre, apellido, email, telefono FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($usuarios) {
    echo '<table border="1">';
    echo '<tr><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th></tr>';
    foreach ($usuarios as $usuario) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($usuario['nombre']) . '</td>';
        echo '<td>' . htmlspecialchars($usuario['apellido']) . '</td>';
        echo '<td>' . htmlspecialchars($usuario['email']) . '</td>';
        echo '<td>' . htmlspecialchars($usuario['telefono']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No hay datos disponibles.';
}
?>
