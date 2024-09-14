<?php
include("../php/connDB.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitización y validación de las entradas del usuario
    $cantidadCotidianas = filter_var($_POST['cantidadCotidianas'], FILTER_VALIDATE_INT);
    $cantidadIntegradoras = filter_var($_POST["cantidadIntegradoras"], FILTER_VALIDATE_INT);
    $grado = $_POST["grado"];
    $materia = $_POST["materia"];
    $periodo = $_POST["periodo"];

    if ($cantidadCotidianas === false || $cantidadIntegradoras === false) {
        die("Entrada inválida.");
    }

    // Manejo de la inserción o actualización de datos
    if (isset($_POST['action']) && $_POST['action'] == 'save') {
        foreach ($_POST['data'] as $id => $data) {
            // Sanitizar y validar los datos
            $cotidianas = implode(',', array_map('floatval', $data['cotidianas']));
            $integradoras = implode(',', array_map('floatval', $data['integradoras']));
            $examen = floatval($data['examen']);
            $promCotidiana = floatval($data['promCotidiana']);
            $promIntegradora = floatval($data['promIntegradora']);
            $promExamen = floatval($data['promExamen']);
            $promFinal = floatval($data['promFinal']);

            // Verificar si el registro ya existe
            $sql = "SELECT * FROM notas WHERE nie='$id' AND grado='$grado' AND materia='$materia' AND periodo='$periodo'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Actualizar el registro existente
                $sql = "UPDATE notas SET 
                        cotidianas='$cotidianas', 
                        integradoras='$integradoras', 
                        examen='$examen', 
                        promCotidiana='$promCotidiana', 
                        promIntegradora='$promIntegradora', 
                        promExamen='$promExamen', 
                        promFinal='$promFinal' 
                        WHERE nie='$id' AND grado='$grado' AND materia='$materia' AND periodo='$periodo'";
            } else {
                // Insertar un nuevo registro
                $sql = "INSERT INTO notas (nie, grado, materia, periodo, cotidianas, integradoras, examen, promCotidiana, promIntegradora, promExamen, promFinal) 
                        VALUES ('$id', '$grado', '$materia', '$periodo', '$cotidianas', '$integradoras', '$examen', '$promCotidiana', '$promIntegradora', '$promExamen', '$promFinal')";
            }

            if (!mysqli_query($conn, $sql)) {
                die("Error al guardar los datos: " . mysqli_error($conn));
            }
        }
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
            <h5>Tabla de: <?php echo htmlspecialchars($grado); ?> GRADO</h5>
            <form id="notasForm" method="POST">
                <input type="hidden" name="grado" value="<?php echo htmlspecialchars($grado); ?>">
                <input type="hidden" name="cantidadCotidianas" value="<?php echo htmlspecialchars($cantidadCotidianas); ?>">
                <input type="hidden" name="cantidadIntegradoras" value="<?php echo htmlspecialchars($cantidadIntegradoras); ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="materia" value="<?php echo htmlspecialchars($materia); ?>">
                <input type="hidden" name="periodo" value="<?php echo htmlspecialchars($periodo); ?>">
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
                        <th>Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $sql = "SELECT nie, apellidos, nombre FROM alumnos WHERE grado='$grado' ORDER BY alumnos.apellidos";
                    $buscar = mysqli_query($conn, $sql);

                    if ($buscar) {
                        $numeroLista = 0;
                        while ($row = mysqli_fetch_assoc($buscar)) {
                            $numeroLista++;
                            $nie = $row["nie"];
                            $nombreCompleto = htmlspecialchars($row["apellidos"] . ", " . $row["nombre"]);

                            // Obtener datos de notas si existen
                            $sqlNotas = "SELECT * FROM notas WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo'";
                            $resultNotas = mysqli_query($conn, $sqlNotas);
                            $notas = mysqli_fetch_assoc($resultNotas);
                            $cotidianas = isset($notas['cotidianas']) ? explode(',', $notas['cotidianas']) : [];
                            $integradoras = isset($notas['integradoras']) ? explode(',', $notas['integradoras']) : [];
                            ?>

                            <tr>
                                <!--GENERAR NÚMERO DE LISTA-->
                                <td><?php echo $numeroLista; ?></td>
                                <!--GENERAR NOMBRE COMPLETO-->
                                <td><input type="text" value="<?php echo $nombreCompleto; ?>" readonly></td>

                                <!--GENERAR NÚMERO DE CELDAS DE ATVIDIDADES COTIDIANAS-->
                                <?php
                                for ($i = 0; $i < $cantidadCotidianas; $i++) {
                                    $valor = isset($cotidianas[$i]) ? htmlspecialchars($cotidianas[$i]) : '';
                                    echo '<td><input class="nota" type="number" min="0" max="10" step="1" name="data[' . $nie . '][cotidianas][]" value="' . $valor . '" data-index="' . $i . '" data-type="cotidianas"></td>';
                                }
                                ?>

                                <td><input class="nota" type="number" min="0" max="10" step="1" name="data[<?php echo $nie; ?>][promCotidiana]" value="<?php echo isset($notas['promCotidiana']) ? htmlspecialchars($notas['promCotidiana']) : ''; ?>" readonly></td>

                                <!--GENERAR NÚMERO DE CELDAS DE ATVIDIDADES INTEGRADORAS-->
                                <?php
                                for ($i = 0; $i < $cantidadIntegradoras; $i++) {
                                    $valor = isset($integradoras[$i]) ? htmlspecialchars($integradoras[$i]) : '';
                                    echo '<td><input class="nota" type="number" min="0" max="10" step="1" name="data[' . $nie . '][integradoras][]" value="' . $valor . '" data-index="' . $i . '" data-type="integradoras"></td>';
                                }
                                ?>
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="data[<?php echo $nie; ?>][promIntegradora]" value="<?php echo isset($notas['promIntegradora']) ? htmlspecialchars($notas['promIntegradora']) : ''; ?>" readonly></td>

                                <!--GENERAR NÚMERO DE CELDAS DE EXAMEN EN ADELANTE-->
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="data[<?php echo $nie; ?>][examen]" value="<?php echo isset($notas['examen']) ? htmlspecialchars($notas['examen']) : ''; ?>"></td>
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="data[<?php echo $nie; ?>][promExamen]" value="<?php echo isset($notas['promExamen']) ? htmlspecialchars($notas['promExamen']) : ''; ?>" readonly></td>
                                <td><input class="nota" type="number" min="0" max="10" step="1" name="data[<?php echo $nie; ?>][promFinal]" value="<?php echo isset($notas['promFinal']) ? htmlspecialchars($notas['promFinal']) : ''; ?>" readonly></td>
                                <td><button type="submit" class="btn btn-primary">Guardar</button></td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='10'>Error en la consulta de la base de datos.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateAverages = (row) => {
            // Obtener valores de las actividades cotidianas
            const cotidianas = Array.from(row.querySelectorAll('input[data-type="cotidianas"]')).map(input => parseFloat(input.value) || 0);
            const integradoras = Array.from(row.querySelectorAll('input[data-type="integradoras"]')).map(input => parseFloat(input.value) || 0);
            
            // Obtener campos de promedios
            const promCotidianaInput = row.querySelector('input[name$="[promCotidiana]"]');
            const promIntegradoraInput = row.querySelector('input[name$="[promIntegradora]"]');
            const examenInput = row.querySelector('input[name$="[examen]"]');
            const promExamenInput = row.querySelector('input[name$="[promExamen]"]');
            const promFinalInput = row.querySelector('input[name$="[promFinal]"]');
            
            // Calcular promedios de actividades
            const averageCotidiana = cotidianas.reduce((a, b) => a + b, 0) / cotidianas.length;
            const averageIntegradora = integradoras.reduce((a, b) => a + b, 0) / integradoras.length;
            const examen = parseFloat(examenInput.value) || 0;
            
            // Actualizar campos de promedio
            promCotidianaInput.value = averageCotidiana*0.35.toFixed(2);
            promIntegradoraInput.value = averageIntegradora*0.35.toFixed(2);
            
            // Calcular promedio de examen
            const averageExamen = examen;
            promExamenInput.value = averageExamen*0.30.toFixed(2);
            
            // Calcular promedio final considerando pesos
            const promFinal = (averageCotidiana * 0.35) + (averageIntegradora * 0.35) + (averageExamen * 0.30);
            promFinalInput.value = promFinal.toFixed(2);
        };
        
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('input', () => updateAverages(row));
        });
    });
    </script>

    <?php
}
?>