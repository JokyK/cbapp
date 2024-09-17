<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CB Maestros - Iniciar Sesión</title>
    <!-- Vincular Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>



                    <?php
                    //VERIFICAR SI YA HAY UNA SESIÓN

                    session_start();
                     //SI SE INICIO ANTERIORMENTE = ENVIAR A LA DASHBOARD
                    if(isset($_SESSION["usuario"])){
                        header('location:../cbapp/main/dashboard.php');
                    }
                    ?>

                    

<!-- Navbar 
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="https://via.placeholder.com/150x40" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-chalkboard-user"></i>MAESTROS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-house"></i>INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-book"></i>NOTAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-user"></i>
                    <?php


                    /*if(!isset($_SESSION["usuario"])){
                        echo"INICIAR SESIÓN";
                    }else{
                        echo $_SESSION['usuario'];
                    }
                        */
                    ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
-->
<!-- Contenido principal -->
<div class="main-content">
    <div class="login-container">
        <?php
            include("../cbapp/php/code_login.php");
            ?>
        <img class="mb-3" width="200px" src="../AppCB/imgs/logocb.png" alt="">
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="correo@clases.edu.sv" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="show" onclick="togglePassword()">
                <label class="form-check-label" for="show">Mostrar</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
        <p class="text-center mt-3">¿Problemas para iniciar sesión? <a href="#">Contactanos</a></p>
    </div>
</div>

<!-- Vincular Bootstrap JS y sus dependencias -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/040fe237ff.js" crossorigin="anonymous"></script>

<!-- Script para mostrar/ocultar contraseña -->
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var showPassword = document.getElementById("show");
        if (showPassword.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
</body>
</html>