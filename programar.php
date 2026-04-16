<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Program Robot - WYDN Robotics Lab</title>
<link rel="stylesheet" href="style.css">
<style>

.simulator {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
    padding: 80px 20px;
}

.canvas {
    width: 400px;
    height: 400px;
    background: #0f1b3d;
    position: relative;
    border-radius: 20px;
    overflow: hidden;
}

.robot {
    width: 140px;   
    height: 140px;  
    background-image: url('robot.png');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    position: absolute;
    top: 130px;
    left: 130px;
    transition: all 0.5s ease;
}

.controls {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.controls button {
    padding: 12px 20px;
    border: none;
    border-radius: 30px;
    background: #274690;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.controls button:hover {
    background: #f7c600;
    color: black;
}

.run-btn {
    background: #28a745 !important;
}

.reset-btn {
    background: #dc3545 !important;
}

</style>
</head>
<body>

<header class="main-header">
    <div class="logo">
        <img src="logo.png" height="40">
    </div>
    <nav>
         <a href="index.php">Tienda</a>
        <a href="projects.php">Proyectos</a>
        <a href="downloads.php">Descargas</a>
        <a href="programar.php">Programar</a>
    </nav>
</header>

<section class="simulator">

<div class="canvas">
    <div class="robot" id="robot"></div>
</div>

<div class="controls">
    <button onclick="addCommand('forward')">Adelante</button>
    <button onclick="addCommand('left')">Izquierda</button>
    <button onclick="addCommand('right')">Derecha</button>
    <button onclick="addCommand('back')">Atras</button>

    <button class="run-btn" onclick="runProgram()">Iniciar</button>
    <button class="reset-btn" onclick="resetRobot()">Resetear</button>
</div>

</section>

<script>

let commands = [];
let robot = document.getElementById("robot");
let x = 130;
let y = 130;
let rotation = 0;

function addCommand(cmd){
    commands.push(cmd);
    alert("Command Added: " + cmd);
}

function runProgram(){
    let delay = 0;

    commands.forEach(cmd => {
        setTimeout(() => {
            if(cmd === "forward") y -= 30;
            if(cmd === "back") y += 30;
            if(cmd === "left") rotation -= 90;
            if(cmd === "right") rotation += 90;

            robot.style.top = y + "px";
            robot.style.left = x + "px";
            robot.style.transform = "rotate(" + rotation + "deg)";
        }, delay);

        delay += 600;
    });

    commands = [];
}

function resetRobot(){
    x = 130;
    y = 130;
    rotation = 0;
    robot.style.top = y + "px";
    robot.style.left = x + "px";
    robot.style.transform = "rotate(0deg)";
    commands = [];
}

</script>

</body>
</html>