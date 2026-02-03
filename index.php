<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>LEGO EV3 Robotics Lab</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
:root{
    --primary:#6c63ff;
    --primary-dark:#554fd8;
    --secondary:#f3f4ff;
    --secondary-dark:#e2e5ff;
    --accent:#ff6584;
    --accent-dark:#e05572;
    --gradient-1:linear-gradient(135deg, #6c63ff 0%, #9a94ff 100%);
    --gradient-2:linear-gradient(135deg, #ff6584 0%, #ff8ea0 100%);
    --gradient-bg:linear-gradient(180deg, #f6f8ff 0%, #e9ecff 50%, #dfe3ff 100%);
    --text:#333;
    --text-light:#666;
    --shadow-sm:0 5px 15px rgba(0,0,0,0.08);
    --shadow-md:0 10px 25px rgba(0,0,0,0.15);
    --shadow-lg:0 20px 40px rgba(0,0,0,0.2);
    --shadow-xl:0 30px 60px rgba(0,0,0,0.25);
}

*{
    box-sizing:border-box;
    font-family:'Segoe UI', 'Poppins', sans-serif;
    margin:0;
    padding:0;
    transition: all 0.3s ease;
}

body{
    margin:0;
    background:var(--gradient-bg);
    color:var(--text);
    min-height:100vh;
    overflow-x:hidden;
}

/* ANIMACIONES */
@keyframes fadeIn {
    from { opacity:0; transform:translateY(20px); }
    to { opacity:1; transform:translateY(0); }
}

@keyframes float {
    0%, 100% { transform:translateY(0); }
    50% { transform:translateY(-10px); }
}

@keyframes pulse {
    0%, 100% { transform:scale(1); }
    50% { transform:scale(1.05); }
}

@keyframes slideIn {
    from { transform:translateX(-20px); opacity:0; }
    to { transform:translateX(0); opacity:1; }
}

@keyframes glow {
    0%, 100% { box-shadow:0 0 20px rgba(108, 99, 255, 0.5); }
    50% { box-shadow:0 0 30px rgba(108, 99, 255, 0.8); }
}

/* HEADER */
header{
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:white;
    box-shadow:var(--shadow-sm);
    position:sticky;
    top:0;
    z-index:1000;
    animation:slideIn 0.5s ease-out;
}

header img{
    height:60px;
    filter:drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
}

/* NAV */
nav{
    display:flex;
    gap:15px;
    align-items:center;
}

nav button{
    background:white;
    border:none;
    padding:12px 22px;
    border-radius:50px;
    cursor:pointer;
    font-weight:600;
    font-size:0.95rem;
    box-shadow:var(--shadow-sm);
    color:var(--text);
    position:relative;
    overflow:hidden;
    z-index:1;
}

nav button::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:var(--gradient-1);
    transition:left 0.4s ease;
    z-index:-1;
}

nav button:hover::before{
    left:0;
}

nav button:hover{
    color:white;
    transform:translateY(-3px);
    box-shadow:var(--shadow-md);
}

/* Botón especial de cerrar sesión */
nav a button{
    background:var(--gradient-2);
    color:white;
    animation: pulse 2s infinite;
}

nav a button:hover{
    background:var(--accent-dark);
    transform:translateY(-3px) scale(1.05);
}

/* DROPDOWN */
.dropdown{
    position:relative;
}

.dropdown-content{
    display:none;
    position:absolute;
    top:50px;
    right:0;
    background:white;
    min-width:260px;
    border-radius:20px;
    box-shadow:var(--shadow-xl);
    overflow:hidden;
    z-index:999;
    animation:fadeIn 0.3s ease;
    border:2px solid var(--secondary);
}

.dropdown-content button{
    width:100%;
    border-radius:0;
    box-shadow:none;
    text-align:left;
    padding:15px 25px;
    border-bottom:1px solid #f0f0f0;
}

.dropdown-content button:hover{
    background:var(--secondary);
    color:var(--primary);
    transform:none;
}

.dropdown-content button:last-child{
    border-bottom:none;
}

/* SECTIONS */
section{
    display:none;
    padding:60px 20px;
    animation:fadeIn 0.6s ease-out;
}
section.active{
    display:block;
}

/* HOME */
.hero{
    max-width:1200px;
    margin:40px auto;
    display:flex;
    gap:60px;
    align-items:center;
    justify-content:center;
    flex-wrap:wrap;
    padding:40px;
}

.robot{
    background:white;
    border-radius:40px;
    padding:50px;
    width:320px;
    box-shadow:var(--shadow-xl);
    animation:float 4s ease-in-out infinite;
    border:5px solid transparent;
    background-clip:padding-box;
    position:relative;
}

.robot::before{
    content:'';
    position:absolute;
    top:-5px;
    left:-5px;
    right:-5px;
    bottom:-5px;
    background:var(--gradient-1);
    border-radius:45px;
    z-index:-1;
    animation:glow 3s infinite;
}

.hero-text{
    max-width:500px;
}

.hero-text h1{
    font-size:3.5rem;
    background:var(--gradient-1);
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
    margin-bottom:20px;
    line-height:1.2;
    text-shadow:2px 2px 4px rgba(0,0,0,0.1);
}

.hero-text p{
    font-size:1.2rem;
    color:var(--text-light);
    line-height:1.6;
    margin-bottom:30px;
}

/* SESSION MESSAGE */
.session-msg{
    background:var(--gradient-1);
    color:white;
    padding:18px;
    margin:30px auto;
    max-width:1200px;
    border-radius:20px;
    text-align:center;
    font-weight:600;
    font-size:1.1rem;
    box-shadow:var(--shadow-md);
    animation:fadeIn 0.8s ease;
    transform-style:preserve-3d;
}

/* CARDS */
.cards{
    max-width:1200px;
    margin:100px auto;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:35px;
}

.card{
    background:white;
    padding:40px;
    border-radius:30px;
    box-shadow:var(--shadow-lg);
    text-align:center;
    transition:all 0.4s ease;
    border:3px solid transparent;
}

.card:hover{
    transform:translateY(-15px) scale(1.03);
    box-shadow:var(--shadow-xl);
    border-color:var(--primary);
}

.card h3{
    color:var(--primary);
    margin-bottom:15px;
    font-size:1.5rem;
}

/* INFO BOX */
.info-box{
    max-width:1100px;
    margin:60px auto;
    background:white;
    padding:60px;
    border-radius:40px;
    box-shadow:var(--shadow-xl);
    position:relative;
    overflow:hidden;
}

.info-box::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:8px;
    height:100%;
    background:var(--gradient-1);
}

.info-box h2{
    color:var(--primary);
    margin-bottom:25px;
    font-size:2.2rem;
    position:relative;
    display:inline-block;
}

.info-box h2::after{
    content:'';
    position:absolute;
    bottom:-10px;
    left:0;
    width:80px;
    height:4px;
    background:var(--gradient-2);
    border-radius:2px;
}

.info-box p{
    font-size:1.1rem;
    line-height:1.8;
    color:var(--text);
}

/* CREATORS */
.creators-section{
    padding:80px 20px;
}

.creators-section h2{
    text-align:center;
    font-size:2.5rem;
    margin-bottom:60px;
    color:var(--primary);
    position:relative;
}

.creators-section h2::after{
    content:'';
    position:absolute;
    bottom:-15px;
    left:50%;
    transform:translateX(-50%);
    width:120px;
    height:5px;
    background:var(--gradient-2);
    border-radius:3px;
}

.creators{
    max-width:1300px;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:35px;
}

.creator{
    background:white;
    padding:40px;
    border-radius:30px;
    box-shadow:var(--shadow-lg);
    text-align:center;
    transition:all 0.4s ease;
    border:3px solid transparent;
}

.creator:hover{
    transform:translateY(-10px);
    box-shadow:var(--shadow-xl);
    border-color:var(--accent);
}

.creator img{
    width:150px;
    height:150px;
    border-radius:50%;
    margin-bottom:25px;
    object-fit:cover;
    border:5px solid var(--secondary);
    box-shadow:var(--shadow-md);
    transition:all 0.4s ease;
}

.creator:hover img{
    transform:scale(1.1);
    border-color:var(--primary);
}

.creator h3{
    color:var(--primary);
    font-size:1.5rem;
    margin-top:15px;
}

/* FORMS */
.form-container{
    min-height:80vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 20px;
}

.form-box{
    background:white;
    max-width:480px;
    width:100%;
    padding:50px;
    border-radius:40px;
    box-shadow:var(--shadow-xl);
    animation:fadeIn 0.8s ease;
    border:3px solid transparent;
    background-clip:padding-box;
    position:relative;
}

.form-box::before{
    content:'';
    position:absolute;
    top:-3px;
    left:-3px;
    right:-3px;
    bottom:-3px;
    background:var(--gradient-1);
    border-radius:43px;
    z-index:-1;
}

.form-box h2{
    text-align:center;
    color:var(--primary);
    font-size:2.2rem;
    margin-bottom:40px;
    position:relative;
    padding-bottom:20px;
}

.form-box h2::after{
    content:'';
    position:absolute;
    bottom:0;
    left:50%;
    transform:translateX(-50%);
    width:60px;
    height:4px;
    background:var(--gradient-2);
    border-radius:2px;
}

.form-box input{
    width:100%;
    padding:18px;
    margin-top:20px;
    border-radius:20px;
    border:2px solid #e0e0e0;
    background:#f9faff;
    font-size:1rem;
    transition:all 0.3s ease;
}

.form-box input:focus{
    outline:none;
    border-color:var(--primary);
    background:white;
    box-shadow:0 0 0 3px rgba(108, 99, 255, 0.1);
    transform:translateY(-2px);
}

.form-box button{
    margin-top:40px;
    width:100%;
    padding:18px;
    background:var(--gradient-1);
    border:none;
    border-radius:25px;
    color:white;
    font-weight:600;
    font-size:1.1rem;
    cursor:pointer;
    letter-spacing:1px;
    transition:all 0.3s ease;
    box-shadow:var(--shadow-md);
}

.form-box button:hover{
    background:var(--primary-dark);
    transform:translateY(-5px);
    box-shadow:var(--shadow-lg);
}

.form-box .forgot-link{
    display:block;
    text-align:center;
    margin-top:25px;
    color:var(--primary);
    text-decoration:none;
    font-weight:500;
    transition:all 0.3s ease;
    position:relative;
}

.form-box .forgot-link::after{
    content:'';
    position:absolute;
    bottom:-2px;
    left:50%;
    transform:translateX(-50%);
    width:0;
    height:2px;
    background:var(--accent);
    transition:width 0.3s ease;
}

.form-box .forgot-link:hover{
    color:var(--accent);
}

.form-box .forgot-link:hover::after{
    width:100%;
}

/* PROJECTS */
.projects-container{
    min-height:80vh;
    padding:60px 20px;
}

.projects-box{
    background:white;
    max-width:800px;
    margin:auto;
    padding:60px;
    border-radius:40px;
    box-shadow:var(--shadow-xl);
    animation:fadeIn 0.8s ease;
    position:relative;
    overflow:hidden;
}

.projects-box::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:8px;
    background:var(--gradient-1);
}

.projects-box h2{
    text-align:center;
    color:var(--primary);
    font-size:2.2rem;
    margin-bottom:40px;
    position:relative;
    padding-bottom:20px;
}

.projects-box h2::after{
    content:'';
    position:absolute;
    bottom:0;
    left:50%;
    transform:translateX(-50%);
    width:80px;
    height:4px;
    background:var(--gradient-2);
    border-radius:2px;
}

.projects-box ul{
    list-style:none;
    padding:0;
}

.projects-box li{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 0;
    border-bottom:2px solid #f0f0f0;
    transition:all 0.3s ease;
}

.projects-box li:hover{
    background:#f9faff;
    padding-left:20px;
    padding-right:20px;
    margin:0 -20px;
    border-radius:15px;
    border-bottom-color:transparent;
}

.projects-box a{
    background:var(--gradient-1);
    color:white;
    padding:10px 25px;
    border-radius:25px;
    text-decoration:none;
    font-weight:600;
    font-size:0.9rem;
    transition:all 0.3s ease;
    box-shadow:var(--shadow-sm);
}

.projects-box a:hover{
    background:var(--primary-dark);
    transform:translateY(-3px);
    box-shadow:var(--shadow-md);
}

/* DOWNLOAD SECTION */
.download-section{
    min-height:70vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 20px;
}

.download-box{
    background:white;
    max-width:600px;
    width:100%;
    padding:60px;
    border-radius:40px;
    box-shadow:var(--shadow-xl);
    text-align:center;
    animation:fadeIn 0.8s ease;
    border:5px solid transparent;
    background-clip:padding-box;
    position:relative;
}

.download-box::before{
    content:'';
    position:absolute;
    top:-5px;
    left:-5px;
    right:-5px;
    bottom:-5px;
    background:var(--gradient-1);
    border-radius:45px;
    z-index:-1;
    animation:glow 3s infinite;
}

.download-box h2{
    color:var(--primary);
    font-size:2.2rem;
    margin-bottom:30px;
}

.download-box .download-btn{
    display:inline-block;
    background:var(--gradient-2);
    color:white;
    padding:20px 50px;
    border-radius:50px;
    text-decoration:none;
    font-weight:600;
    font-size:1.2rem;
    margin-top:20px;
    transition:all 0.3s ease;
    box-shadow:var(--shadow-lg);
    animation:pulse 2s infinite;
}

.download-box .download-btn:hover{
    background:var(--accent-dark);
    transform:translateY(-5px) scale(1.05);
    box-shadow:var(--shadow-xl);
    animation:none;
}

/* FOOTER */
footer{
    margin-top:120px;
    background:var(--gradient-1);
    padding:40px 20px;
    text-align:center;
    color:white;
    font-size:1.1rem;
    font-weight:500;
    position:relative;
    overflow:hidden;
}

footer::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:5px;
    background:var(--gradient-2);
}

/* RESPONSIVE */
@media (max-width:768px){
    header{
        padding:15px 20px;
        flex-direction:column;
        gap:20px;
    }
    
    nav{
        flex-wrap:wrap;
        justify-content:center;
    }
    
    .hero-text h1{
        font-size:2.5rem;
    }
    
    .info-box, .projects-box, .form-box, .download-box{
        padding:40px 25px;
    }
    
    .creators, .cards{
        grid-template-columns:1fr;
        gap:25px;
    }
}

/* SCROLLBAR */
::-webkit-scrollbar{
    width:12px;
}

::-webkit-scrollbar-track{
    background:var(--secondary);
}

::-webkit-scrollbar-thumb{
    background:var(--gradient-1);
    border-radius:6px;
}

::-webkit-scrollbar-thumb:hover{
    background:var(--primary-dark);
}
</style>
</head>

<body>

<header>
    <img src="images-removebg-preview.png" alt="LEGO EV3 Logo">
    <nav>
        <button onclick="showSection('home')">🏠 Inicio</button>

        <?php if(!isset($_SESSION['usuario'])): ?>
            <button onclick="showSection('login')">🔑 Login</button>
            <button onclick="showSection('register')">📝 Registro</button>
        <?php else: ?>
            <button onclick="showSection('download')">⬇️ Descargar</button>
            <button onclick="showSection('projects')">🤖 Proyectos EV3</button>
            <a href="logout.php"><button style="background:var(--gradient-2);color:white;">🚪 Cerrar sesión</button></a>
        <?php endif; ?>

        <div class="dropdown">
            <button onclick="toggleDropdown()">✨ Más ▾</button>
            <div class="dropdown-content" id="dropdownMenu">
                <button onclick="showSection('info')">📚 Información</button>
                <button onclick="showSection('history')">📜 Historia EV3</button>
                <button onclick="showSection('creators')">👥 Creadores</button>
            </div>
        </div>
    </nav>
</header>

<section id="home" class="active">
<?php if(isset($_SESSION['usuario'])): ?>
<div class="session-msg">🎉 ¡Has iniciado sesión correctamente! Bienvenido/a</div>
<?php endif; ?>
<div class="hero">
    <div class="robot"><img src="EV3_Mindstorms.png" width="100%" alt="Robot EV3"></div>
    <div class="hero-text">
        <h1>LEGO EV3 Robotics Lab</h1>
        <p>Aprende robótica y programación de forma divertida. Explora, crea y transforma tus ideas en realidad con el poder de LEGO Mindstorms EV3. ¡La aventura robótica comienza aquí!</p>
        <div class="cards">
            <div class="card">
                <h3>🎓 Educativo</h3>
                <p>Aprende conceptos STEM de manera práctica</p>
            </div>
            <div class="card">
                <h3>⚡ Divertido</h3>
                <p>Combina juego y aprendizaje</p>
            </div>
            <div class="card">
                <h3>🚀 Innovador</h3>
                <p>Desarrolla habilidades del futuro</p>
            </div>
        </div>
    </div>
</div>
</section>

<section id="info">
<div class="info-box">
    <h2>📚 Información</h2>
    <p>Esta página está diseñada para ayudar a los estudiantes a aprender a usar los robots LEGO Mindstorms EV3 de una manera fácil, divertida y educativa. Aquí encontrarás información sobre qué es el robot EV3, para qué sirve, cuáles son sus partes principales y cómo programarlo paso a paso.

    El objetivo de esta página es que los alumnos comprendan cómo funcionan los robots, desarrollen el pensamiento lógico y aprendan los conceptos básicos de programación y robótica mediante ejemplos, actividades y explicaciones sencillas. Es un espacio pensado para aprender mientras se experimenta y se crea.</p>
</div>
</section>

<section id="history">
<div class="info-box">
    <h2>📜 Historia EV3</h2>
    <p>LEGO Mindstorms EV3, lanzado en septiembre de 2013, es la tercera generación de robots programables de LEGO, sucediendo a NXT y RCX. Desarrollado para educación y aficionados, el EV3 ("Evolution 3") introdujo un bloque inteligente más potente, motores mejorados y sensores más precisos, consolidándose como herramienta clave en robótica educativa.</p>
    
    <div style="margin-top:30px; padding:20px; background:var(--secondary); border-radius:20px;">
        <h3 style="color:var(--primary); margin-bottom:10px;">🚀 Evolución LEGO Mindstorms</h3>
        <p>• <strong>1998:</strong> Primera generación RCX<br>
           • <strong>2006:</strong> Segunda generación NXT<br>
           • <strong>2013:</strong> Tercera generación EV3 (Actual)<br>
           • <strong>2020:</strong> LEGO Mindstorms Robot Inventor</p>
    </div>
</div>
</section>

<section id="creators" class="creators-section">
<h2>👥 Creadores</h2>
<div class="creators">
<div class="creator">
    <img src="wilmer.jpg" alt="Wilmer López">
    <h3>Wilmer López</h3>
    <p style="color:var(--text-light); margin-top:10px;">Desarrollador Principal</p>
</div>
<div class="creator">
    <img src="dahiana.jpg" alt="Dahiana Sosa">
    <h3>Dahiana Sosa</h3>
    <p style="color:var(--text-light); margin-top:10px;">Diseñadora UI/UX</p>
</div>
<div class="creator">
    <img src="nayeli.jpg" alt="Nayeli Paulino">
    <h3>Nayeli Paulino</h3>
    <p style="color:var(--text-light); margin-top:10px;">Especialista en Contenidos</p>
</div>
<div class="creator">
    <img src="yelfry.jpg" alt="Yelfry Peralta">
    <h3>Yelfry Peralta</h3>
    <p style="color:var(--text-light); margin-top:10px">Coordinador de Proyectos</p>
</div>
</div>
</section>

<section id="login">
<div class="form-container">
<form class="form-box" action="login.php" method="POST">
<h2>🔑 Iniciar Sesión</h2>
<input name="correo" type="email" placeholder="📧 Correo electrónico" required>
<input name="password" type="password" placeholder="🔒 Contraseña" required>
<button>🚀 Entrar</button>
<a href="forgot.php" class="forgot-link">¿Olvidaste tu contraseña?</a>
</form>
</div>
</section>

<section id="register">
<div class="form-container">
<form class="form-box" action="register.php" method="POST">
<h2>📝 Crear Cuenta</h2>
<input name="usuario" placeholder="👤 Nombre de usuario" required>
<input name="correo" type="email" placeholder="📧 Correo electrónico" required>
<input name="password" type="password" placeholder="🔒 Contraseña" required>
<button>🎯 Registrarse</button>
</form>
</div>
</section>

<section id="download">
<div class="download-section">
<div class="download-box">
<h2>⬇️ Descargar Software LEGO EV3</h2>
<p style="color:var(--text-light); margin-bottom:30px; font-size:1.1rem;">Obtén la última versión del software oficial de LEGO Mindstorms EV3 para comenzar tu aventura en robótica</p>
<a href="hi-ev3-3-1.xapk" download class="download-btn">📥 Descargar Ahora</a>
<p style="margin-top:30px; color:var(--text-light); font-size:0.9rem;">Versión 3.1 | Compatible con Windows, macOS, iOS y Android</p>
</div>
</div>
</section>

<section id="projects">
<div class="projects-container">
<div class="projects-box">
<h2>🤖 Proyectos EV3</h2>
<ul>
<li>Seguidor de línea<a href="proyectos/Seguidor_de_linea.lmsp" download>⬇️ Descargar</a></li>
<li>Evitador de obstáculos<a href="proyectos/Evitador_de_obstaculos.lmsp" download>⬇️ Descargar</a></li>
<li>Michael Jackson<a href="proyectos/Michael_Jackson.lmsp" download>⬇️ Descargar</a></li>
<li>Moves and Turns<a href="proyectos/Moves_and_Turns.lmsp" download>⬇️ Descargar</a></li>
<li>Optimus Prime<a href="proyectos/Optimus_Prime.lmsp" download>⬇️ Descargar</a></li>
<li>Project 1<a href="proyectos/Project_1.lmsp" download>⬇️ Descargar</a></li>
<li>Project 2<a href="proyectos/Project_2.lmsp" download>⬇️ Descargar</a></li>
<li>Proyecto Final<a href="proyectos/Proyecto_Final.lmsp" download>⬇️ Descargar</a></li>
<li>Sensores EV3<a href="proyectos/Sensores.lmsp" download>⬇️ Descargar</a></li>
<li>SUMO BATTLE<a href="proyectos/SUMO_BATTLE.lmsp" download>⬇️ Descargar</a></li>
</ul>
</div>
</div>
</section>

<footer>
Proyecto Educativo LEGO EV3 © 2026 | Robótica para el Futuro 🤖
</footer>

<script>
function showSection(id){
    document.querySelectorAll("section").forEach(s=>{
        s.classList.remove("active");
        s.style.opacity = "0";
    });
    
    const section = document.getElementById(id);
    section.classList.add("active");
    
    setTimeout(() => {
        section.style.opacity = "1";
    }, 50);
    
    // Cerrar dropdown si está abierto
    const dropdown = document.getElementById("dropdownMenu");
    if(dropdown.style.display === "block"){
        dropdown.style.display = "none";
    }
    
    // Scroll suave al inicio de la sección
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function toggleDropdown(){
    const d = document.getElementById("dropdownMenu");
    d.style.display = d.style.display === "block" ? "none" : "block";
}

// Cerrar dropdown al hacer clic fuera
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById("dropdownMenu");
    const dropdownBtn = document.querySelector('.dropdown button');
    
    if (!dropdown.contains(event.target) && event.target !== dropdownBtn) {
        dropdown.style.display = 'none';
    }
});

// Efecto de carga inicial
document.addEventListener('DOMContentLoaded', function() {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s ease';
    
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
    
    // Agregar hover effects a las tarjetas
    document.querySelectorAll('.card, .creator').forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = this.classList.contains('card') 
                ? 'translateY(-15px) scale(1.03)' 
                : 'translateY(-10px)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>

</body>
</html>