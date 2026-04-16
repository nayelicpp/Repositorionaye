<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>WYDN Robotics Lab</title>
<link rel="stylesheet" href="style.css">
<script src="script.js" defer></script>
</head>
<body>

<header class="main-header">
    <div class="logo">
    <img src="logo.png" alt="WYDN Robotics Lab Logo">
</div>

    <nav>
        <a href="index.php">Tienda</a>
        <a href="projects.php">Proyectos</a>
        <a href="downloads.php">Descargas</a>
        <a href="creators.php">Creadores</a>
        <a href="programar.php">Programar</a>

        <?php
        $cartCount = 0;
        if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $qty){
                $cartCount += $qty;
            }
        }
        ?>
        <a class="cart-btn" href="cart.php">🛒 Carrito (<?php echo $cartCount; ?>)</a>

        <?php if(!isset($_SESSION['user'])){ ?>
            <a class="auth-btn" href="login.php">Login</a>
            <a class="auth-btn register" href="register.php">Register</a>
        <?php } else { ?>
            <?php if($_SESSION['user']['role'] == 'admin'){ ?>
                <a class="admin-btn" href="admin.php">Admin</a>
            <?php } ?>
            <a class="logout-btn" href="logout.php">Logout</a>
        <?php } ?>
    </nav>
</header>

<section class="hero">
    <div class="hero-content">
        <h1>Construye Programa. Innovar.</h1>
        <p>WYDN Robotics Lab: Transformando Codigos en La Realidad</p>
        <a href="#store" class="btn-main">Explorar Tienda</a>
    </div>
</section>

<section id="store" class="products">

<h2 class="section-title">Nuestra tienda de Robots</h2>

<div class="product-grid">

<?php
$result = $conn->query("SELECT * FROM products");

if($result && $result->num_rows > 0){

while($row = $result->fetch_assoc()){
?>

<div class="card">
    <div class="card-image">
        <img src="uploads/<?php echo $row['image']; ?>">
    </div>
    <div class="card-body">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <div class="card-footer">
            <span class="price">$<?php echo $row['price']; ?></span>
            <button onclick="addToCart(<?php echo $row['id']; ?>)">Add</button>
        </div>
    </div>
</div>

<?php 
}
} else { ?>

<div class="no-products">
    <h3>No hay Productos Disponibles Todavia</h3>
    <p>El administrador debe agregar productos desde el panel de control.</p>
</div>

<?php } ?>
</div>
</section>

<section class="info-section">
    <h2 class="section-title">Por que Elegir WYDN Robotics Lab?</h2>
    <div class="info-boxes">
        <div class="info-card">
            <h3>⚡ Robotica Avanzada</h3>
            <p>Componentes y herramientas LEGO EV3 de alta calidad.</p>
        </div>
        <div class="info-card">
            <h3>📥 Descargas Gratis</h3>
            <p>Descarga programas de robótica y materiales didácticos.</p>
        </div>
        <div class="info-card">
            <h3>🚀 Proyectos Reales</h3>
            <p>Explora Proyectos Realizados por Nuestro Grupo</p>
        </div>
    </div>
</section>

<footer>
    <p>© <?php echo date("Y"); ?> WYDN Robotics Lab</p>
    <p>Creador Por Wilmer, Yelfry, Dahiana & Nayeli</p>
</footer>

</body>
</html>