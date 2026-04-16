<?php
include 'config.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<h1>Bienvenido a EV3 Robotics Platform</h1>
<p>Usuario: <?php echo $_SESSION['user']; ?></p>

<ul>
<li><a href="programming.php">Programar Robot</a></li>
<li><a href="projects.php">Descargar Proyectos</a></li>
<li><a href="downloads.php">Software EV3</a></li>
<li><a href="store.php">Tienda Robots</a></li>
<li><a href="logout.php">Cerrar Sesión</a></li>
</ul>
