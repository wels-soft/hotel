<?php
require 'conexion.php';

$ci_ruc   = $_POST['ci_ruc'];
$nombre   = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email    = $_POST['email'];
$telefono = $_POST['telefono'];
$numero   = $_POST['numero_habitacion'];
$noches   = $_POST['noches'];
$accion   = $_POST['accion']; // 'registro' o 'reserva'

// 1. Buscar si la habitación existe por su número (101, 102...)
$stmtHab = $pdo->prepare("SELECT habitacion_id, disponible FROM Habitaciones WHERE numero = ?");
$stmtHab->execute([$numero]);
$hab = $stmtHab->fetch(PDO::FETCH_ASSOC);

if (!$hab) {
    header("Refresh: 3; url=index.php");
    die("<link rel='stylesheet' href='estilos.css?v=2'><h3>❌ La habitación #$numero no existe.</h3>");
}

// 2. Buscar huésped por Cédula/RUC; si no existe, crearlo
$stmtHuesped = $pdo->prepare("SELECT huesped_id FROM Huespedes WHERE ci_ruc = ?");
$stmtHuesped->execute([$ci_ruc]);
$huesped = $stmtHuesped->fetch(PDO::FETCH_ASSOC);

if ($huesped) {
    $huesped_id = $huesped['huesped_id'];
} else {
    $pdo->prepare("INSERT INTO Huespedes (ci_ruc, nombre, apellido, email, telefono) VALUES (?, ?, ?, ?, ?)")
        ->execute([$ci_ruc, $nombre, $apellido, $email, $telefono]);
    $huesped_id = $pdo->lastInsertId();
}

// 3. Guardar la operación en Reservas
$pdo->prepare("INSERT INTO Reservas (huesped_id, habitacion_id, noches) VALUES (?, ?, ?)")
    ->execute([$huesped_id, $hab['habitacion_id'], $noches]);

// 4. Cambiar estado: 0 = Ocupada (Registro), 2 = Reservada (Reserva)
$nuevoEstado = ($accion === 'registro') ? 0 : 2;
$textoEstado = ($accion === 'registro') ? '🔴 Ocupada (Registro)' : '🟠 Reservada';

$pdo->prepare("UPDATE Habitaciones SET disponible = ? WHERE habitacion_id = ?")
    ->execute([$nuevoEstado, $hab['habitacion_id']]);

header("Refresh: 3; url=index.php");
echo "<link rel='stylesheet' href='estilos.css?v=2'><h3>✅ Habitación #$numero marcada como $textoEstado por $noches noches.</h3><p>Volviendo al inicio...</p>";
?>