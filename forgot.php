<?php
include "db.php";

$msg = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $correo = $_POST['correo'];

    // verificar si el correo existe
    $stmt = $conn->prepare("SELECT correo FROM users WHERE correo=?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){

        // enviar a n8n
        $url = "https://wilmer12.app.n8n.cloud/webhook-test/recuperar";

        $data = [
            "correo" => $correo
        ];

        $options = [
            "http" => [
                "header"  => "Content-type: application/json",
                "method"  => "POST",
                "content" => json_encode($data),
            ]
        ];

        $context  = stream_context_create($options);
        file_get_contents($url, false, $context);

        $msg = "Correo enviado. Revisa tu email.";
    }
    else{
        $msg = "Ese correo no existe.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Recuperar contraseña</title>
<style>
body{
    font-family:Segoe UI;
    background:linear-gradient(180deg,#f6f8ff,#e9ecff);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    padding:40px;
    border-radius:30px;
    box-shadow:0 20px 40px rgba(0,0,0,.2);
    width:350px;
    text-align:center;
}

input{
    width:100%;
    padding:14px;
    margin-top:15px;
    border-radius:16px;
    border:1px solid #ddd;
    background:#f6f7ff;
}

button{
    margin-top:25px;
    width:100%;
    padding:14px;
    background:#6c63ff;
    border:none;
    border-radius:20px;
    color:white;
    font-weight:600;
    cursor:pointer;
}

.msg{
    margin-top:15px;
    color:#333;
    font-weight:600;
}
</style>
</head>

<body>

<form method="POST" class="box">
<h2>Recuperar contraseña</h2>

<input type="email" name="correo" placeholder="Tu correo" required>
<button>Enviar correo</button>

<?php if($msg): ?>
<div class="msg"><?= $msg ?></div>
<?php endif; ?>

</form>

</body>
</html>
