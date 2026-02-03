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

$sql = "INSERT INTO users (usuario, correo, password)
        VALUES ('$usuario', '$correo', '$passwordHash')";

if ($conn->query($sql)) {
    $_SESSION['usuario'] = $usuario; // 👈 sesión iniciada
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $conn->error;
}
?>
