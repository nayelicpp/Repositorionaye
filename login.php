<?php 
include 'config.php';
include 'layout.php';

$error = "";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            if($user['role'] == 'admin'){
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }
            exit();

        } else {
            $error = "Incorrect password.";
        }

    } else {
        $error = "Email not found.";
    }
}
?>

<a href="index.php" class="btn-back">⬅ Volver</a>

<h1 class="page-title">🔐 Login</h1>

<div class="form-container">

<?php if($error != ""){ ?>
<div class="error-box"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login" class="main-btn">Login</button>

</form>

</div>

<?php include 'footer.php'; ?>