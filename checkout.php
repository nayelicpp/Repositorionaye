<?php
session_start();
include 'config.php';
include 'layout.php';

// 🔒 LOGIN
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

// 🛒 CARRITO
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "<p style='text-align:center;'>Your cart is empty.</p>";
    include 'footer.php';
    exit();
}

// 💾 MANTENER DATOS
$fullname = $_POST['fullname'] ?? '';
$address = $_POST['address'] ?? '';
$city = $_POST['city'] ?? '';
$phone = $_POST['phone'] ?? '';
$payment = $_POST['payment'] ?? '';
$paypal_email = $_POST['paypal_email'] ?? '';
$card_number = $_POST['card_number'] ?? '';

// 💰 TOTAL + ITEMS
$total = 0;
$items = [];

foreach($_SESSION['cart'] as $id => $qty){
    $stmt = $conn->prepare("SELECT name, price FROM products WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if($product){
        $total += $product['price'] * $qty;

        $items[] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'qty' => $qty
        ];
    }
}

// 🎟️ DESCUENTO
$discount = 0;
$discountCode = "SHAFFARD10";
$message = "";

if(isset($_POST['apply_code'])){
    if($_POST['discount_code'] == $discountCode){
        $discount = $total * 0.10;
        $_SESSION['discount'] = $discount;
        $message = "<p style='color:green;'>✅ 10% aplicado</p>";
    } else {
        $message = "<p style='color:red;'>❌ Código inválido</p>";
    }
}

if(isset($_SESSION['discount'])){
    $discount = $_SESSION['discount'];
}

$finalTotal = $total - $discount;

// 🧾 PROCESAR COMPRA
if(isset($_POST['place_order'])){

    if(empty($fullname) || empty($address) || empty($city) || empty($phone)){
        $message = "<p style='color:red;'>Completa los datos de envío</p>";
    } else {

        if($payment == "card"){
            if(empty($_POST['card_number']) || empty($_POST['card_cvv'])){
                $message = "<p style='color:red;'>Faltan datos de tarjeta</p>";
            }
        }

        if($payment == "paypal"){
            if(empty($_POST['paypal_email'])){
                $message = "<p style='color:red;'>Falta email de PayPal</p>";
            }
        }

        if(empty($message)){

            // 🧾 FACTURA PRO
            $_SESSION['invoice'] = [
                'order_id' => rand(100000,999999),
                'fullname' => $fullname,
                'address' => $address,
                'city' => $city,
                'phone' => $phone,
                'items' => $items,
                'subtotal' => number_format($total,2),
                'discount' => number_format($discount,2),
                'total' => number_format($finalTotal,2)
            ];

            unset($_SESSION['cart']);
            unset($_SESSION['discount']);

            header("Location: success.php");
            exit();
        }
    }
}
?>

<h1 class="checkout-title">💳 Verificar</h1>

<div class="checkout-wrapper">
<div class="checkout-card">

<h2>Total: $<?php echo number_format($finalTotal,2); ?></h2>

<?php echo $message; ?>

<form method="POST">

<h3>Método de Pago</h3>

<div class="payment-options">
    <label>
        <input type="radio" name="payment" value="card" required <?php if($payment=='card') echo 'checked'; ?>>
        <span>💳 Tarjeta</span>
    </label>

    <label>
        <input type="radio" name="payment" value="paypal" <?php if($payment=='paypal') echo 'checked'; ?>>
        <span>🅿️ PayPal</span>
    </label>
</div>

<!-- TARJETA -->
<div id="card-info" style="display:none;">
    <h3>Datos de Tarjeta</h3>
    <input type="text" name="card_name" placeholder="Nombre">
    <input type="text" name="card_number" placeholder="Número" value="<?php echo $card_number; ?>">
    <input type="text" name="card_exp" placeholder="MM/AA">
    <input type="text" name="card_cvv" placeholder="CVV">
</div>

<!-- PAYPAL -->
<div id="paypal-info" style="display:none;">
    <h3>PayPal</h3>
    <input type="email" name="paypal_email" placeholder="Correo PayPal" value="<?php echo $paypal_email; ?>">
</div>

<!-- ENVÍO -->
<h3>Envío</h3>

<div class="shipping-grid">
    <input type="text" name="fullname" placeholder="Nombre completo" required value="<?php echo $fullname; ?>">
    <input type="text" name="address" placeholder="Dirección" required value="<?php echo $address; ?>">
    <input type="text" name="city" placeholder="Ciudad" required value="<?php echo $city; ?>">
    <input type="text" name="phone" placeholder="Teléfono" required value="<?php echo $phone; ?>">
</div>

<!-- DESCUENTO -->
<h3>Código</h3>

<div class="discount-box">
    <input type="text" name="discount_code" placeholder="Código">
    <button type="submit" name="apply_code" formnovalidate>Aplicar</button>
</div>

<button type="submit" name="place_order" class="confirm-btn">
    Confirmar Pago
</button>

</form>

</div>
</div>

<script>
const radios = document.querySelectorAll('input[name="payment"]');
const card = document.getElementById('card-info');
const paypal = document.getElementById('paypal-info');

function togglePayment(){
    card.style.display = 'none';
    paypal.style.display = 'none';

    if(document.querySelector('input[value="card"]').checked){
        card.style.display = 'block';
    }
    if(document.querySelector('input[value="paypal"]').checked){
        paypal.style.display = 'block';
    }
}

radios.forEach(r => {
    r.addEventListener('change', togglePayment);
});

window.onload = togglePayment;
</script>

<?php include 'footer.php'; ?>