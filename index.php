<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CB Maestros - Iniciar Sesión</title>
    <!-- Vincular Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <div id="particles-js"></div>
    
    <?php
    session_start();
    if(isset($_SESSION["usuario"])){
        header('location: main/dashboard.php');
    }
    ?>

    <!-- Contenido principal -->
    <div class="main-content animate__animated animate__fadeIn">
        <div class="login-container animate__animated animate__zoomIn">
            <?php include("php/code_login.php"); ?>
            <img class="mb-3" width="200px" src="imgs/logocb.png" alt="">
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
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="scripts.js"></script>

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

        // Añadir animación al botón de inicio de sesión
        document.querySelector('button[type="submit"]').addEventListener('click', function(){
            this.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => this.classList.remove('animate__pulse'), 500);
        });
    </script>
</body>
</html>