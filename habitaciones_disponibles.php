<?php
require 'conexion.php';

function obtenerHabitacionesDisponibles($pdo) {
    $sql = "SELECT * FROM Habitaciones WHERE disponible = 1";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ejemplo de uso:
// $habitaciones = obtenerHabitacionesDisponibles($pdo);
// foreach($habitaciones as $hab) echo $hab['numero'] . " - " . $hab['tipo'];
?>