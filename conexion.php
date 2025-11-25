<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli('localhost', 'root', '', 'escuela');

if ($mysqli->connect_error) {
    die('Error en la conexión: ' . $mysqli->connect_error);
}
?>
