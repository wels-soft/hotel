<?php
require 'conexion.php';

function crearReserva($pdo, $huesped_id, $habitacion_id, $fecha_entrada, $fecha_salida) {
    try {
        // Iniciar transacción
        $pdo->beginTransaction();

        // 1. Verificar si la habitación está disponible
        $stmt_check = $pdo->prepare("SELECT disponible FROM Habitaciones WHERE habitacion_id = ? FOR UPDATE");
        $stmt_check->execute([$habitacion_id]);
        $habitacion = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if (!$habitacion || $habitacion['disponible'] == 0) {
            throw new Exception("La habitación no está disponible.");
        }

        // 2. Insertar la reserva
        $sql_reserva = "INSERT INTO Reservas (huesped_id, habitacion_id, fecha_entrada, fecha_salida) VALUES (?, ?, ?, ?)";
        $stmt_reserva = $pdo->prepare($sql_reserva);
        $stmt_reserva->execute([$huesped_id, $habitacion_id, $fecha_entrada, $fecha_salida]);

        // 3. Marcar la habitación como no disponible
        $sql_update = "UPDATE Habitaciones SET disponible = 0 WHERE habitacion_id = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([$habitacion_id]);

        // Confirmar transacción
        $pdo->commit();
        return "Reserva creada con éxito.";

    } catch (Exception $e) {
        // Revertir cambios si hay un error
        $pdo->rollBack();
        return "Error al reservar: " . $e->getMessage();
    }
}

// Ejemplo de uso:
// echo crearReserva($pdo, 1, 5, '2026-12-01', '2026-12-05');
?>