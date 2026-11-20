<?php
require 'conexion.php';

$habitaciones = $pdo->query("SELECT * FROM Habitaciones")->fetchAll(PDO::FETCH_ASSOC);
$libres = count(array_filter($habitaciones, fn($h) => $h['disponible'] == 1));

require 'vista_principal.php';
?>