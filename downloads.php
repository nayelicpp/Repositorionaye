<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Downloads - WYDN Robotics Lab</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="main-header">
    <div class="logo">🤖 WYDN Robotics Lab</div>
    <nav>
         <a href="index.php">Tienda</a>
        <a href="projects.php">Proyectos</a>
        <a href="downloads.php">Descargas</a>
        
    </nav>
</header>

<section class="products">
<h2 class="section-title">EV3 Software Downloads</h2>

<div class="product-grid">

<?php
$folder = "programas/";

if(is_dir($folder)){
    $files = scandir($folder);

    foreach($files as $file){
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if(in_array($ext, ['msi','dmg','xapk'])){

            // Detectar sistema
            $platform = "";
            if($ext == "msi") $platform = "Windows";
            if($ext == "dmg") $platform = "Mac OS";
            if($ext == "xapk") $platform = "Android";
?>

<div class="card">
    <div class="card-body project-card">
        <h3 class="project-title"><?php echo $platform; ?></h3>
        <p><?php echo $file; ?></p>
        <a class="download-btn" href="programas/<?php echo $file; ?>" download>
            Download for <?php echo $platform; ?>
        </a>
    </div>
</div>

<?php
        }
    }
}
?>

</div>
</section>

</body>
</html>