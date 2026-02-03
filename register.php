<?php
session_start();
include "db.php";

$usuario  = $_POST['usuario'] ?? '';
$correo   = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

if ($usuario === '' || $correo === '' || $password === '') {
    echo "Completa todos los campos";
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (usuario, correo, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $usuario, $correo, $passwordHash);

if ($stmt->execute()) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
?>
