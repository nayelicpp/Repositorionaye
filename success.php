<?php
session_start();
include 'layout.php';
?>

<style>
.success-container{
    display:flex;
    justify-content:center;
    align-items:center;
    height:80vh;
    text-align:center;
}

.success-box{
    background:#0f172a;
    padding:40px;
    border-radius:15px;
    color:white;
    width:400px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.success-box h1{
    font-size:28px;
    margin-bottom:15px;
}

.success-box p{
    color:#cbd5f5;
    margin-bottom:25px;
}

.home-btn{
    display:inline-block;
    padding:12px 25px;
    background:#22c55e;
    color:white;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.home-btn:hover{
    background:#16a34a;
}
</style>

<div class="success-container">
    <div class="success-box">
        <h1>🎉 ¡Gracias por tu compra!</h1>
        <p>Tu pedido ha sido procesado correctamente.</p>
        <p>La factura se descargará automáticamente en unos segundos...</p>

        <!-- 🔥 BOTÓN -->
        <a href="index.php" class="home-btn">🏠 Volver al inicio</a>
    </div>
</div>

<script>
// ⏳ Descargar factura después de 5 segundos
setTimeout(function(){
    window.location.href = "invoice.php";
}, 5000);
</script>

<?php include 'footer.php'; ?>