<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($correo === '' || $password === '') {
        die("Campos vacíos");
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

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
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h2>Iniciar sesión</h2>

<form method="POST">
<input type="email" name="correo" placeholder="Correo" required>
<input type="password" name="password" placeholder="Contraseña" required>
<button type="submit">Entrar</button>
</form>

<br>
<a href="forgot.php">¿Olvidaste tu contraseña?</a>

</body>
</html>
