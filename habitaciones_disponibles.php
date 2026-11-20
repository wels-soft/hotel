<?php
require 'conexion.php';

$habitaciones = $pdo->query("SELECT * FROM Habitaciones WHERE disponible = 1")->fetchAll(PDO::FETCH_ASSOC);
$total = count($habitaciones);

require 'vista_habitaciones.php';
?>