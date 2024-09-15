<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard para Maestros</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="notas.css">
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>


<?php
    session_start();
    include("../php/connDB.php"); // Conexión a la base de datos

    if (!isset($_SESSION["usuario"])) {
        header("location:../index.php");
    }

    $dui = $_SESSION["dui"];

    // Consulta para obtener los grados del profesor
    $consultaGrados = "SELECT cod_grado FROM maestros_grados WHERE dui_maestro = '$dui'";
    $resultadoGrados = mysqli_query($conn, $consultaGrados);

    if (!$resultadoGrados) {
        echo "Error en la consulta: " . mysqli_error($conn);
        exit;
    }
?>

<div class="d-flex" id="wrapper">
 <!-- Sidebar -->
    <div class="bg-dark border-right d-flex flex-column" id="sidebar-wrapper">
    <div class="sidebar-heading text-white py-3 px-3 fs-4 fw-bold">Panel de Maestro</div>
        <div id="menu" class="list-group list-group-flush flex-grow-1">
            <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
                <i class="fa-solid fa-home me-2"></i> Inicio
            </a>
            
            <a id="libretaNotasLink" class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center position-relative">
            <i class="fa-solid fa-chalkboard-user me-2"></i> Grados
            </a>
            <!-- Submenú que se despliega al hacer clic -->
            <div id="submenuGrados" class="submenu-grados list-group">
                <?php 
                mysqli_data_seek($resultadoGrados, 0); // Reiniciar puntero del resultado
                while ($fila = mysqli_fetch_assoc($resultadoGrados)) { ?>
                    <a href="grados.php?grado=<?php echo $fila['cod_grado']; ?>" class="list-group-item"><?php echo $fila['cod_grado']; ?></a>
                <?php } ?>
            </div>


            <a href="lugares.php" class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
            <i class="fa-solid fa-trophy me-2"></i> Lugares
            </a>


            <a href="#" class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
                <i class="fas fa-user-graduate me-2"></i> Estudiantes
            </a>

            
            <a href="notas.php" class="list-group-item list-group-item-action bg-dark text-white d-flex align-items-center">
                <i class="fa-solid fa-scroll me-2"></i> Notas
            </a>
        </div>

        <!-- Botón de Cerrar sesión al final de la sidebar -->
        <a href="../php/logout.php" class="list-group-item list-group-item-action bg-danger text-white text-center py-3 mt-auto">
            <i class="fa-solid fa-sign-out-alt me-2"></i> Cerrar sesión
        </a>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle"><i class="fa-solid fa-bars"></i></button>
        </nav>

        <div class="container-fluid">
            <h1 class="mt-4">Bienvenido, <?php echo $_SESSION["usuario"]. ", ". $_SESSION["dui"] ?></h1>
            <p>Este es tu panel de control donde puedes gestionar tus clases, estudiantes, tareas y notas.</p>
        
        
                    <?php
                    include("../php/generarTablaLibreta.php");
                    ?>
        
        
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/040fe237ff.js" crossorigin="anonymous"></script>
<!-- Script personalizado -->
<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("wrapper").classList.toggle("toggled");
    });

      // Script para mostrar/ocultar el submenú con animación
      document.getElementById("libretaNotasLink").addEventListener("click", function() {
            var submenu = document.getElementById("submenuGrados");
            if (submenu.style.maxHeight) {
                // Si maxHeight está definido, colapsa el submenú
                submenu.style.maxHeight = null;
                submenu.style.display = "none";
            } else {
                // Si maxHeight no está definido, despliega el submenú
                submenu.style.display = "flex";
                submenu.style.maxHeight = submenu.scrollHeight + "px";
            }
        });
</script>
</body>
</html>
