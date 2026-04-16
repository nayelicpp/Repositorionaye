<?php include 'config.php'; ?>
<h2>Laboratorio EV3</h2>
<textarea rows="10" cols="60">
# Programa EV3
left_motor.run(500)
right_motor.run(500)
wait(2000)
</textarea>
<br>
<button onclick="run()">Ejecutar</button>

<div id="robot" style="width:100px;height:100px;background:#FFD500;margin-top:20px;position:relative;"></div>

<script>
function run(){
    let robot=document.getElementById("robot");
    robot.style.left="200px";
}
</script>
