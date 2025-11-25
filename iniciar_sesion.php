<?php

session_start();

require 'conexion.php';

$mensaje = "";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

  
    $email = $mysqli->real_escape_string($email);
    $contrasena = $mysqli->real_escape_string($contrasena);

   
    $sql_check = "SELECT id, contrasena FROM estudiantes WHERE correo = ?";
    $stmt = $mysqli->prepare($sql_check);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
       
        $stmt->bind_result($id, $password_db);
        $stmt->fetch();

    
        if ($contrasena === $password_db) {
        
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            header("Location: bienvenida.php");  
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "La cuenta no existe.";
    }

    $stmt->close();
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>


    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            padding: 50px 0;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            border-radius: 5px;
            padding: 15px;
            font-size: 16px;
            width: 100%;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 15px;
            font-size: 16px;
            border-radius: 5px;
            color: white;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            color: white;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .message h3 {
            color: red;
        }

        .message a {
            color: #007bff;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

<div class="container">
    <div class="row text-center mt-5">
        <h2>Iniciar Sesión</h2>
    </div>

 
    <div class="row text-center">

    </div>

  
    <div class="row">
        <form action="login.php" method="POST">
            <div class="form-group mb-3">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group mb-3">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>

            <a href="bienvenida.php" class="nav-link btn btn-primary ms-3">Iniciar Sesion</a>

        </form>
    </div>
<div>
    <div>

    </div>
</div>
    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary">Regresar al Inicio</a>
    </div>
</div>

</body>
</html>
