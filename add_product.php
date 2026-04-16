<?php
include 'config.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

$imageName = time() . "_" . $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);

$stmt = $conn->prepare("INSERT INTO products (name, price, image, description) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdss", $name, $price, $imageName, $description);
$stmt->execute();

header("Location: admin.php");
exit();