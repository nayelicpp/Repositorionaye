<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            scroll-behavior: smooth;
        }

        header {
            background: linear-gradient(45deg, #e60000, #8b0000);
        }

        .card img {
            height: 220px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">

    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#inicio">Equipo 5</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#inicio">Equipo 5</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#registro">Registro</a>
                </li>
                
                <li class="nav-item">
                    <a href="iniciar_sesion.php" class="nav-link btn btn-primary ms-3">Iniciar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



                </ul>
            </div>
        </div>
    </nav>

    
    <section id="inicio" class="container my-5 pt-5">
        <h2 class="text-center mb-4">Bienvenidos al proyecto del grupo 5</h2>
        <div class="row">
            
            <div class="col-md-4">
                <div class="card">
                    <img src="img/WhatsApp Image 2025-11-25 at 8.14.43 AM.jpeg" class="card-img-top" alt="Imagen 1">
                    <div class="card-body">
                        <h5 class="card-title">Nayeli Paulino</h5>
                        <p class="card-text">Lider, hizo la base de datos en xampp,la conexion y la pagina</p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="card">
                    <img src="img/WhatsApp Image 2025-11-25 at 9.38.08 AM.jpeg" class="card-img-top" alt="Imagen 2">
                    <div class="card-body">
                        <h5 class="card-title">Wilmer Lopez</h5>
                        <p class="card-text">Ayudante, ayudo en la realizacion de la pagina</p>
                    </div>
                </div>
            </div>

           
            <div class="col-md-4">
                <div class="card">
                    <img src="img/WhatsApp Image 2025-11-25 at 9.51.55 AM.jpeg" class="card-img-top" alt="Imagen 3">
                    <div class="card-body">
                        <h5 class="card-title">Dahiana Vasquez</h5>
                        <p class="card-text">Programadora, creo el repositorio en github y subio los codigos</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <img src="img/WhatsApp Image 2025-11-25 at 10.19.59 AM.jpeg" class="card-img-top" alt="Imagen 3">
                    <div class="card-body">
                        <h5 class="card-title">Jelfry Peralta</h5>
                        <p class="card-text">Programador,Ayudo en la realizacion de la pagina</p>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

   
    <section id="registro" class="container my-5">
        <h2 class="text-center mb-4">Registro de Usuario</h2>

        <div class="container">
            <h3 class="mb-4">Formulario de Registro</h3>
            <form action="registro.php" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="form-group mb-3">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group mb-3">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                </div>

                <div class="form-group mb-3">
                    <label for="foto">Foto:</label>
                    <input type="text" class="form-control" id="foto" name="foto" required>
                </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </section>


    
    <footer class="bg-dark text-white text-center p-3 mt-5">
        Proyecto realizado por el Equipo XX — 2025
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
