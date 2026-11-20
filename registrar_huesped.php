<?php
require 'conexion.php';

function registrarHuesped($pdo, $nombre, $apellido, $email, $telefono) {
    $sql = "INSERT INTO Huespedes (nombre, apellido, email, telefono) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellido, $email, $telefono]);
    return $pdo->lastInsertId();
}

// Ejemplo de uso:
// $id_nuevo = registrarHuesped($pdo, 'Juan', 'Pérez', 'juan@email.com', '555-1234');
?>