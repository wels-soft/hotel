<?php
require 'conexion.php';

$huesped_id    = $_POST['huesped_id'];
$habitacion_id = $_POST['habitacion_id'];
$noches        = $_POST['noches'];

// 1. Guardar la reserva con el número de noches
$sql = "INSERT INTO Reservas (huesped_id, habitacion_id, noches) VALUES (?, ?, ?)";
$pdo->prepare($sql)->execute([$huesped_id, $habitacion_id, $noches]);

// 2. Marcar habitación como no disponible (0)
$pdo->prepare("UPDATE Habitaciones SET disponible = 0 WHERE habitacion_id = ?")->execute([$habitacion_id]);

header("Refresh: 3; url=index.html");
echo "<link rel='stylesheet' href='estilos.css'><h3>✅ Reserva creada por $noches noches.</h3><p>Volviendo al inicio...</p>";
?>