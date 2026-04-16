<?php 
include 'config.php';
include 'layout.php';
?>

<a href="index.php" class="btn-back">⬅ Continua Comprando</a>

<h1 class="page-title">🛒 Tu Carrito</h1>

<?php
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "<p style='text-align:center;'>Tu Carrito Esta Vacio.</p>";
} else {

$total = 0;

echo "<div class='cart-container'>";

foreach($_SESSION['cart'] as $id => $qty){

    $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if($product){

        $subtotal = $product['price'] * $qty;
        $total += $subtotal;

        $imagePath = "uploads/" . $product['image'];
        if(!file_exists($imagePath)){
            $imagePath = "https://via.placeholder.com/300x200";
        }

        echo "
        <div class='cart-item'>
            <img src='$imagePath'>
            
            <div class='cart-info'>
                <h3>{$product['name']}</h3>
                <p>Price: \${$product['price']}</p>
                
                <div class='qty-controls'>
                    <a href='update_cart.php?action=decrease&id=$id'>➖</a>
                    <span>$qty</span>
                    <a href='update_cart.php?action=increase&id=$id'>➕</a>
                </div>

                <p class='subtotal'>Subtotal: \$$subtotal</p>

                <a href='update_cart.php?action=remove&id=$id' class='remove-btn'>Remove</a>
            </div>
        </div>
        ";
    }
}

echo "</div>";

echo "<div class='cart-total'>
        <h2>Total: $$total</h2>
        <a href='checkout.php' class='checkout-btn'>Proceed to Checkout</a>
    </div>";
}
?>

<?php include 'footer.php'; ?>