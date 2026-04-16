<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'base_datos');

// Registrar la descarga
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

$stmt = $conexion->prepare("INSERT INTO descargas (ip, user_agent) VALUES (?, ?)");
$stmt->bind_param("ss", $ip, $user_agent);
$stmt->execute();

// Redirigir al archivo a descargar
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="programa.exe"');
header('Content-Length: ' . filesize('ruta/programa.exe'));
readfile('ruta/programa.exe');
?>