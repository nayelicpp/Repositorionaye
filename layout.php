<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>WYDN Robotics Lab</title>
<link rel="stylesheet" href="style.css">
<script src="script.js" defer></script>
</head>
<body>

<header class="main-header">
    <div class="logo">
        🤖 WYDN Robotics Lab
    </div>

    <nav class="nav-links">
        <a href="index.php">Tienda</a>
        <a href="projects.php">Proyectos</a>
        <a href="downloads.php">Descargas</a>
        <a href="creators.php">Creadores</a>

        <?php
        $cartCount = 0;
        if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $qty){
                $cartCount += $qty;
            }
        }
        ?>

        <a href="cart.php" class="cart-link">🛒 Carrito(<?php echo $cartCount; ?>)</a>

        <?php if(!isset($_SESSION['user'])){ ?>
            <a href="login.php" class="auth-btn">Login</a>
            <a href="register.php" class="auth-btn register">Register</a>
        <?php } else { ?>
            <?php if($_SESSION['user']['role']=='admin'){ ?>
                <a href="admin.php" class="admin-btn">Admin</a>
            <?php } ?>
            <a href="logout.php" class="auth-btn">Logout</a>
        <?php } ?>
    </nav>
</header>

<div class="page-container">