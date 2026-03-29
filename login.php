<?php
session_start();
include "db.php";

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE correo='$correo'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['usuario'] = $user['usuario'];
        header("Location: index.php");
        exit;
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>
