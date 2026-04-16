<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Proyectos - WYDN Robotics Lab</title>
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
<h2 class="section-title">EV3 Proyectos</h2>

<div class="product-grid">

<?php
$folder = "proyectos/";

if(is_dir($folder)){
    $files = scandir($folder);

    foreach($files as $file){
        if(pathinfo($file, PATHINFO_EXTENSION) == "lmsp"){
?>

<div class="card">
    <div class="card-body project-card">
        <h3 class="project-title"><?php echo pathinfo($file, PATHINFO_FILENAME); ?></h3>
        <a class="download-btn" href="proyectos/<?php echo $file; ?>" download>
            Download Project
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