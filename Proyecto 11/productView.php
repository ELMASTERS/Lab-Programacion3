<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Productos Disponibles</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo $product['name'] . " - $" . $product['price']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
