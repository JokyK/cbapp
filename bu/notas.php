<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard para Maestros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="notas.css">
</head>



<body>


<?php
    session_start();
    include("../php/connDB.php");


    if (!isset( $_SESSION["usuario"])){
        header("location:index.php");
    }
    ?>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">Panel de Maestro</div><br>
            <div class="list-group list-group-flush">
               <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark text-white"><i id="sidebar-icon" class="fa-solid fa-home"></i> Inicio</a> 
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i id="sidebar-icon" class="fas fa-chalkboard"></i>Grados</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i id="sidebar-icon" class="fa-solid fa-spell-check"></i>Materias</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i id="sidebar-icon" class="fas fa-user-graduate"></i>Estudiantes</a>
                <a href="#" id="active" class="list-group-item list-group-item-action bg-dark text-white"><i id="sidebar-icon" class="fa-solid fa-scroll"></i>Notas</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle"><i id="sidebar-icon" class="fa-solid fa-bars"></i></button>
            </nav>

            
            <?php
            /*
            include("../php/connDB.php");
            $email = $_SESSION["usuario"];
            $sql = "SELECT grado, materia from maestros where correo = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){ 
                $row = $result->fetch_assoc();
                echo"".$row["grado"]."".$row["materia"]."";
                $num = $result ->num_rows;
            }
                */
            ?>
            <div class="container-fluid">
                <h1 class="mt-4">Bienvenido, <?php echo $_SESSION["usuario"] ?></h1>
                <p>Estas en la sección de notas, aca puedes agregar las notas de tus grados y materias.</p>
                <!-- Aquí puedes agregar más contenido como gráficos, estadísticas, etc. -->

                    <div class="form-container">
                        <form class="form" method="post">

                                <label for="cantidadCotidianas">N° Actividades Cotidianas:</label>
                                <select name="cantidadCotidianas" id="cantidadCotidianas">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>

                                <label for="cantidadIntegradoras">N° Actividades Integradoras:</label>
                                <select name="cantidadIntegradoras" id="cantidadIntegradoras">
                                    <option value="1">1</option>
                                </select>




                                <label for="grado">Grado:</label>
                                <select name="grado" id="grado">
                                <!--<option value=""></option>-->
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


                                <label for="materia">Materia:</label>
                                <select name="materia" id="materia">
                                <!--<option value=""></option>-->
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

                                <label for="periodo">Periodo:</label>
                                <select name="periodo" id="periodo">
                                    <option value="1PER">1PER</option>
                                    <option value="2PER">2PER</option>
                                    <option value="3PER">3PER</option>
                                </select>

                                

                                
                                <input type="submit" value="+ CREAR TABLA">
                        </form>
                    </div>

                    
                    </div>
                    <?php
                        include("../php/generarTablaNotas.php");
                        ?>
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
    </script>
</body>
</html>