<?php
include 'config.php';
include 'layout.php';

$error = "";
$success = "";

if(isset($_POST['register'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(strlen($password) < 6){
        $error = "Password must be at least 6 characters.";
    } else {

        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $check = $stmt->get_result();

        if($check->num_rows > 0){
            $error = "Email already registered!";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt->bind_param("sss", $name, $email, $hashedPassword);
            $stmt->execute();

            // Auto login
            $_SESSION['user'] = [
                'name' => $name,
                'email' => $email,
                'role' => 'user'
            ];

            header("Location: index.php");
            exit();
        }
    }
}
?>

<a href="index.php" class="btn-back">⬅ Volver</a>

<h1 class="page-title">📝 Crear Cuenta</h1>

<div class="form-container">

<?php if($error != ""){ ?>
<div class="error-box"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password (min 6 chars)" required>

<button type="submit" name="register" class="main-btn">Register</button>

</form>

<p style="text-align:center; margin-top:15px;">
Ya Tienes Cuenta Creada? 
<a href="login.php" style="color:#facc15;">Login</a>
</p>

</div>

<?php include 'footer.php'; ?>