<?php
require 'conexion.php';

$ci_ruc   = $_POST['ci_ruc'];
$nombre   = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email    = $_POST['email'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO Huespedes (ci_ruc, nombre, apellido, email, telefono) VALUES (?, ?, ?, ?, ?)";
$pdo->prepare($sql)->execute([$ci_ruc, $nombre, $apellido, $email, $telefono]);

echo "Huésped registrado con éxito. <a href='index.html'>Volver al inicio</a>";
?>