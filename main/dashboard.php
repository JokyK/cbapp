<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard para Maestros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sidebar.css">

    <!-- Estilo personalizado para reducir la altura del banner -->
    <style>
        #banner .carousel-item img {
            filter: brightness(.7);
            height: 600px; /* Puedes ajustar la altura aquí */
            object-fit: cover; /* Hace que la imagen se ajuste correctamente dentro del espacio */
            border-radius: 5px;
        }
    </style>
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
            <button class="btn btn-primary mr-2" id="menu-toggle"><i class="fa-solid fa-bars"></i></button><h style="font-weight: bold;">INICIO</h>
        </nav>

        <div class="container-fluid">
        <h2 class="mt-2" style="color: #343a40;">Bienvenido, Prof. <?php echo $_SESSION["nombre"] ?>.</h2>
            <p>Este es tu panel de control donde puedes gestionar tus clases, estudiantes, tareas y notas.</p>

            <!-- Banner -->
            <div id="banner" class="mt-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../imgs/educacion1.jpg" class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                            <img src="../imgs/educacion2.jpg" class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                            <img src="../imgs/educacion3.jpg" class="d-block w-100" alt="Banner 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        
            <!-- Sección de Noticias -->
            <div class="row mt-5">
                <div class="col-12">
                    <h3>Últimas Noticias</h3>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <img src="noticia1.jpg" class="card-img-top" alt="Noticia 1">
                        <div class="card-body">
                            <h5 class="card-title">Noticia 1</h5>
                            <p class="card-text">Descripción breve de la noticia 1.</p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <img src="noticia2.jpg" class="card-img-top" alt="Noticia 2">
                        <div class="card-body">
                            <h5 class="card-title">Noticia 2</h5>
                            <p class="card-text">Descripción breve de la noticia 2.</p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <img src="noticia3.jpg" class="card-img-top" alt="Noticia 3">
                        <div class="card-body">
                            <h5 class="card-title">Noticia 3</h5>
                            <p class="card-text">Descripción breve de la noticia 3.</p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/040fe237ff.js" crossorigin="anonymous"></script>
<!-- Script personalizado -->
<script src="animacionesSidebar.js"></script>
</body>
</html>
