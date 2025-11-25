<?php


require 'C:\xampp\htdocs\sistema\Estudiante\conexion.php';  


$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$foto = $_POST['foto']; 


$contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);


$sql = "INSERT INTO estudiantes (nombre, apellido, correo, contrasena, foto) 
        VALUES (?, ?, ?, ?, ?)";


$stmt = $mysqli->prepare($sql);


if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $mysqli->error);
}


$stmt->bind_param("sssss", $nombre, $apellido, $email, $contrasena_hash, $foto);


if ($stmt->execute()) {
    $mensaje = "Registro guardado correctamente";
} else {
    $mensaje = "Error al guardar el registro: " . $stmt->error;
}


$stmt->close();


$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row" style="text-align:center">
        <h3><?php echo $mensaje; ?></h3>
    </div>
</div>

<a href="index.php" class="btn btn-primary">Regresar</a>

</body>
</html>
