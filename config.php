<?php
// Iniciar sesión solo si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conexión a base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "wydn_robotics";

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Configurar charset
$conn->set_charset("utf8mb4");
?>