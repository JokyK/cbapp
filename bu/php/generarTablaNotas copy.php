<?php
include("../php/connDB.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitización y validación de las entradas del usuario
    $cantidadCotidianas = filter_var($_POST['cantidadCotidianas'], FILTER_VALIDATE_INT);
    $cantidadIntegradoras = filter_var($_POST["cantidadIntegradoras"], FILTER_VALIDATE_INT);
    $grado = $_POST["grado"];   

    if ($cantidadCotidianas === false || $cantidadIntegradoras === false) {
        die("Entrada inválida.");
        
    }
    ?>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            text-align: center;
        }

        input {
            width: 100px;
            font-size: 12px;
        }

        .nota {
            width: 50px;
        }
    </style>

    <div class="ml-5 mr-5 mt-5">
        <div class="table-responsive">
            <h5>Tabla de: <?php echo $grado ?> GRADO</h5>
            <form id="notasForm" onsubmit="calcularPromedios(event)">
                <table class="table table-striped table-bordered">

                    <!--HEAD DE LA TABLA-->
                    <thead class="thead-dark">
                    <tr>
                        <th>N°</th>
                        <th>Alumno</th>
                        <th colspan="<?php echo $cantidadCotidianas; ?>">Actividad Cotidiana 35%</th>
                        <th>Prom. Cot</th>
                        <th colspan="<?php echo $cantidadIntegradoras; ?>">Actividad Integradora 35%</th>
                        <th>Prom. Int</th>
                        <th>Examen 30%</th>
                        <th>Prom. Exa</th>
                        <th>Prom. Final</th>
                    </tr>
                    </thead>

                    <tbody>
                      <!--
                       <tr>
                    <td></td>
                    <td></td>
                    <?php /*
                    for ($i = 0; $i < $cantidadCotidianas; $i++) {
                        echo '<td><input type="text"></td>';
                    }*/
                    ?>
                    <td>PC</td>
                    <td><input type="text"></td>
                    <td>PI</td>
                    <td><input type="text"></td>
                    <td>PE</td>
                    <td>PF</td>
                </tr>
-->
                    <!--CONTENIDO DE LA TABLA A GENERAR POR ALUMNO-->
                    <?php
                    $sql = "SELECT nie, apellidos, nombre FROM alumnos WHERE grado='$grado' ORDER BY alumnos.apellidos";
                    $buscar = mysqli_query($conn, $sql);

                    if ($buscar) {
                        $numeroLista = 0;
                           while ($row = mysqli_fetch_assoc($buscar)) {
                            $numeroLista++;
                            $nie = $row["nie"];
                            $nombreCompleto = htmlspecialchars($row["apellidos"] . ", " . $row["nombre"]);
                            ?>

                            <tr>
                                <!--GENERAR NÚMERO DE LISTA-->
                                <td><?php echo $numeroLista; ?></td>
                                <!--GENERAR NOMBRE COMPLETO-->
                                <td><input type="text" value="<?php echo $nombreCompleto; ?>" readonly></td>

                                <!--GENERAR NÚMERO DE CELDAS DE ATVIDIDADES COTIDIANAS-->
                                <?php
                                for ($i = 0; $i < $cantidadCotidianas; $i++) {
                                    echo '<td><input class="nota" type="number" min="0" max="10" step="1" name="cotidianas"></td>';
                                }
                                ?>

                                    
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="promCotidiana" readonly></td>
                                
                                <!--GENERAR NÚMERO DE CELDAS DE ATVIDIDADES INTEGRADORAS-->
                                <?php
                                for ($i = 0; $i < $cantidadIntegradoras; $i++) {
                                    echo '<td><input class="nota" type="number" min="0" max="10" step="1" name="integradoras"></td>';
                                }
                                ?>
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="promIntegradora" readonly></td>

                                <!--GENERAR NÚMERO DE CELDAS DE EXAMEN EN ADELANTE-->
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="examen"></td>
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="promExamen" readonly></td>
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="promFinal" readonly></td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>Error en la consulta de la base de datos.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Calcular Promedios</button>
            </form>
        </div>
    </div>

    <script>
        function calcularPromedios(event) {
            event.preventDefault();
            const form = document.getElementById('notasForm');
            const filas = form.querySelectorAll('tbody tr');

            filas.forEach(fila => {
                // Calcular promedio de Cotidianas
                const notasCotidianas = fila.querySelectorAll('input[name^="cotidianas"]');
                const promCotidiana = fila.querySelector('input[name^="promCotidiana"]');
                let sumaCotidianas = 0;

                notasCotidianas.forEach(nota => {
                    sumaCotidianas += parseFloat(nota.value) || 0;
                });
                promCotidiana.value = (sumaCotidianas / notasCotidianas.length *0.35).toFixed(2);

                // Calcular promedio de Integradoras
                const notasIntegradoras = fila.querySelectorAll('input[name^="integradoras"]');
                const promIntegradora = fila.querySelector('input[name^="promIntegradora"]');
                let sumaIntegradoras = 0;

                notasIntegradoras.forEach(nota => {
                    sumaIntegradoras += parseFloat(nota.value) || 0;
                });
                promIntegradora.value = (sumaIntegradoras / notasIntegradoras.length *0.35).toFixed(2);

                // Calcular promedio de Examen
                const examen = parseFloat(fila.querySelector('input[name^="examen"]').value) * 0.30 || 0;
                const promExamen = fila.querySelector('input[name^="promExamen"]');
                promExamen.value = examen.toFixed(2);

                // Calcular promedio final
                const promFinal = fila.querySelector('input[name^="promFinal"]');
                promFinal.value = (parseFloat(promCotidiana.value) + 
                                   parseFloat(promIntegradora.value) + 
                                   (parseFloat(promExamen.value))).toFixed(2);
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
}
?>