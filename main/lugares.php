<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel > Lugares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="notas.css">
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
            <button class="btn btn-primary mr-2" id="menu-toggle"><i class="fa-solid fa-bars"></i></button><h style="font-weight: bold;" >LUGARES</h>
            </nav>

            <div class="container-fluid">
                <h1 class="mt-4">Bienvenido, <?php echo $_SESSION["usuario"] ?></h1>
                <p>Estas en la sección de notas, aca puedes agregar las notas de tus grados y materias.</p>
                <!-- Aquí puedes agregar más contenido como gráficos, estadísticas, etc. -->

                    <div class="form-container">
                        <form class="form" method="post" action="../php/generarTablaLugares.php" >
                            
                                <div class="form-group">
                                <label for="grado">Grado:</label>
                                <select name="grado" id="grado" class="form-control" required>
                                <option value="">Grado</option>
                                <?php
                                $dui = $_SESSION["dui"];
                                $consulta = "SELECT * FROM maestros_grados WHERE dui_maestro =  '$dui'";
                                $resultado = mysqli_query($conn,$consulta);
                                if ($resultado){
                                    while($row = mysqli_fetch_assoc($resultado)){
                                        ?>

                                        <option value="<?php echo $row["cod_grado"] ?>"><?php echo $row["cod_grado"] ?></option>                                        

                                        <?php
                                    }
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="materia">Materia:</label>
                                <select name="materia" id="materia" class="form-control" required >
                                <option value="">Materia</option>
                                <?php
                                $dui = $_SESSION["dui"];
                                $consulta = "SELECT * FROM maestros_materias WHERE dui_maestro =  '$dui'";
                                $resultado = mysqli_query($conn,$consulta);
                                if ($resultado){
                                    while($row = mysqli_fetch_assoc($resultado)){
                                        ?>

                                        <option value="<?php echo $row["cod_materia"] ?>"><?php echo $row["cod_materia"] ?></option>                                        

                                        <?php
                                    }
                                }
                                ?>
                                </select>
                                </div>
                                <input type="submit" value="CARGAR TABLA" class="btn btn-primary">
                        </form>
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