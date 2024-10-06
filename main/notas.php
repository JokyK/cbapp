<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel > Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="notas.css">
    <link rel="stylesheet" href="sidebar.css">

</head>

<body>

<?php
    session_start();
    include("../php/connDB.php");

    if (!isset($_SESSION["usuario"])) {
        header("location:../index.php");
    }

    $dui = $_SESSION["dui"];

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
            <div id="submenuGrados" class="submenu-grados list-group">
                <?php 
                mysqli_data_seek($resultadoGrados, 0);
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

        <a href="../php/logout.php" class="list-group-item list-group-item-action bg-danger text-white text-center py-3 mt-auto">
            <i class="fa-solid fa-sign-out-alt me-2"></i> Cerrar sesión
        </a>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary mr-2" id="menu-toggle"><i class="fa-solid fa-bars"></i></button><h style="font-weight: bold;">INICIO</h>
        </nav>

        <div class="container-fluid">
            <h2 class="mt-2" style="color: #343a40;">Bienvenido, Prof. <?php echo $_SESSION["nombre"]; ?>.</h2>
            <p>Estás en la sección de notas, aquí puedes agregar las notas de tus grados y materias.</p>

            <div class="form-container">
                <h5 class="h5">Seleccione para cargar la tabla de insertar</h5>
                <form action="../php/generarTablaNotas.php" method="post">
                    <div class="form-group">
                        <label for="grado">Seleccione un grado:</label>
                        <select name="grado" id="grado" class="form-control" required >
                            <option value="">Grado</option>
                            <?php
                            $consulta = "SELECT * FROM maestros_grados WHERE dui_maestro = '$dui'";
                            $resultado = mysqli_query($conn, $consulta);
                            if ($resultado) {
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                    <option value="<?php echo $row["cod_grado"]; ?>"><?php echo $row["cod_grado"]; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="materia">Seleccione una materia:</label>
                        <select name="materia" id="materia" class="form-control" required>
                            <option value="">Materia</option>
                            <?php
                            $consulta = "SELECT * FROM maestros_materias WHERE dui_maestro = '$dui'";
                            $resultado = mysqli_query($conn, $consulta);
                            if ($resultado) {
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                    <option value="<?php echo $row["cod_materia"]; ?>"><?php echo $row["cod_materia"]; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="periodo">Seleccione un trimestre:</label>
                        <select name="periodo" id="periodo" class="form-control" required>
                            <option value="">Trimestre</option>
                            <option value="1PER">1° Trimestre</option>
                            <option value="2PER">2° Trimestre</option>
                            <option value="3PER">3° Trimestre</option>
                        </select>
                    </div>
                        <input type="submit" value="CARGAR TABLA" class="btn btn-primary">
                </form>
            </div>

        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/040fe237ff.js" crossorigin="anonymous"></script>
<!-- Script personalizado -->
<script src="animacionesSidebar.js"></script>

</body>
</html>