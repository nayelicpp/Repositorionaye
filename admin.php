<?php
include 'config.php';
include 'layout.php';

// 🔒 Protección de Admin
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

// 📊 Estadísticas
$totalUsers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$totalProducts = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
?>

<a href="index.php" class="btn-back">⬅ Volver a la Tienda</a>

<h1 class="page-title">⚙ Admin Dashboard</h1>

<div class="dashboard-stats">

<div class="stat-card">
<h3>👤 Usuario</h3>
<p><?php echo $totalUsers; ?></p>
</div>

<div class="stat-card">
<h3>📦 Productos</h3>
<p><?php echo $totalProducts; ?></p>
</div>

<div class="stat-card">
<h3>💰 Systema</h3>
<p>Activo</p>
</div>

</div>

<div class="card-grid">

<div class="page-card">
<h3>➕ Agregar Producto</h3>

<form method="POST" action="add_product.php" enctype="multipart/form-data">
<input name="name" placeholder="Product Name" required>
<input name="price" type="number" step="0.01" placeholder="Price" required>
<input type="file" name="image" required>
<textarea name="description" placeholder="Description"></textarea>
<button class="main-btn">Agregar Producto</button>
</form>
</div>

<div class="page-card">
<h3>📋 Lista de Productos</h3>

<div class="admin-products">

<?php
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");

while($row = $result->fetch_assoc()){
?>

<div class="admin-product-item">
<img src="uploads/<?php echo $row['image']; ?>" width="60">
<div>
<strong><?php echo $row['name']; ?></strong>
<p>$<?php echo $row['price']; ?></p>
</div>
<a href="delete_product.php?id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
</div>

<?php } ?>

</div>

</div>

</div>

<?php include 'footer.php'; ?>