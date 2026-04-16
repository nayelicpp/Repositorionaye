<?php
include 'config.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin.php");
exit();