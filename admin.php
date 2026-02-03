<?php
session_start();
// Verificar que sea admin
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'base_datos');

// Obtener estadísticas
$total = $conexion->query("SELECT COUNT(*) as total FROM descargas")->fetch_assoc();
$hoy = $conexion->query("SELECT COUNT(*) as hoy FROM descargas WHERE DATE(fecha) = CURDATE()")->fetch_assoc();
$mes = $conexion->query("SELECT COUNT(*) as mes FROM descargas WHERE MONTH(fecha) = MONTH(CURDATE())")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Admin - Descargas</title>
</head>
<body>
    <h1>Estadísticas de Descargas</h1>
    <p>Total descargas: <?php echo $total['total']; ?></p>
    <p>Descargas hoy: <?php echo $hoy['hoy']; ?></p>
    <p>Descargas este mes: <?php echo $mes['mes']; ?></p>
    
    <h2>Historial reciente</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>IP</th>
        </tr>
        <?php
        $resultado = $conexion->query("SELECT * FROM descargas ORDER BY fecha DESC LIMIT 50");
        while($fila = $resultado->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['fecha']; ?></td>
            <td><?php echo $fila['ip']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>