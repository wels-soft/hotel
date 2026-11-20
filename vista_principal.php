<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control del Hotel</title>
    <link rel="stylesheet" href="estilos.css?v=2">
</head>
<body>

    <h1 class="titulo-centro">Control de Hotel</h1>

    <div class="contenedor">
        <!-- Columna Izquierda: Formulario Único -->
        <div class="columna">
            <h2>Formulario de Registro / Reserva</h2>
            <form action="procesar.php" method="POST">
                <p>Cédula / RUC: <input type="text" name="ci_ruc" required></p>
                <p>Nombre: <input type="text" name="nombre" required></p>
                <p>Apellido: <input type="text" name="apellido" required></p>
                <p>Email: <input type="email" name="email"></p>
                <p>Teléfono: <input type="text" name="telefono"></p>
                <p># Número de Habitación: <input type="number" name="numero_habitacion" placeholder="Ej: 101" required></p>
                <p>Cantidad de Noches: <input type="number" name="noches" required></p>

                <div class="botones">
                    <button type="submit" name="accion" value="registro" class="btn-registro">Registro (Ocupar)</button>
                    <button type="submit" name="accion" value="reserva" class="btn-reserva">Reserva</button>
                </div>
            </form>
        </div>

        <!-- Columna Derecha: Tabla de Habitaciones -->
        <div class="columna">
            <h2>Habitaciones (Libres: <?= $libres ?>)</h2>
            <table>
                <tr>
                    <th># Habitación</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
                <?php foreach ($habitaciones as $hab): ?>
                <tr>
                    <td><?= $hab['numero'] ?></td>
                    <td><?= $hab['tipo'] ?></td>
                    <td>$<?= $hab['precio'] ?></td>
                    <td>
                        <?php
                            if ($hab['disponible'] == 1) echo '🟢 Libre';
                            elseif ($hab['disponible'] == 2) echo '🟠 Reservada';
                            else echo '🔴 Ocupada';
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>
</html>