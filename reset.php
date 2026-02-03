<?php
include "db.php";

$correo = $_POST['correo'] ?? '';

if ($correo === '') {
    die("Correo vacío");
}

/* URL webhook n8n */
$url = "https://wilmer12.app.n8n.cloud/webhook-test/recuperar";

/* enviar correo a n8n */
$data = json_encode(["correo" => $correo]);

$options = [
    "http" => [
        "header" => "Content-Type: application/json",
        "method" => "POST",
        "content" => $data
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$result = json_decode($response, true);

if ($result && $result["success"]) {

    $newPass = password_hash($result["newPassword"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE correo=?");
    $stmt->bind_param("ss", $newPass, $correo);
    $stmt->execute();

    echo "Nueva contraseña enviada al correo.";
} else {
    echo "Error al recuperar contraseña.";
}
?>
