<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Habitaciones Disponibles</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <h2>Habitaciones Disponibles: <?= $total ?></h2>
    <p><a href="index.html">← Volver al inicio</a></p>

    <table>
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Tipo</th>
            <th>Precio</th>
        </tr>
        <?php foreach ($habitaciones as $hab): ?>
        <tr>
            <td><?= $hab['habitacion_id'] ?></td>
            <td><?= $hab['numero'] ?></td>
            <td><?= $hab['tipo'] ?></td>
            <td>$<?= $hab['precio'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>