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
        width: 10px;
        border-radius: 4px;
        border: 1px solid black;
        background-color: white;
        padding: 2px;
        text-align: center;
    }

    /* Estilo para las columnas de Nota Final (NF y PF) */
    .nota-final {
        background-color: #ffff99; /* Fondo amarillo */
        font-weight: bold; /* Negrita para resaltar */
    }
</style>

<div class="alert alert-success" role="alert" style="width: 100%; text-align:center; padding: 5px; margin-top: 20px;">
    <?php
        include("../php/connDB.php");
        $dui = $_SESSION["dui"];
        $nie = $_GET["nie"];
        $consulta = "SELECT * FROM alumnos WHERE nie = '$nie'";
        $resultado = mysqli_query($conn, $consulta);
        if (mysqli_num_rows($resultado) > 0) {
            $resultado = mysqli_fetch_assoc($resultado);
            $nombre = $resultado["nombre"];
            $apellidos = $resultado["apellidos"];
        }
    ?>
    Datos cargados correctamente <h5>Tabla de notas de: <?php echo $nombre . " " . $apellidos; ?></h5>
</div>

<div class="ml-5 mr-5 mt-5">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th colspan="7">1er Periodo</th>
                    <th colspan="7">2do Periodo</th>
                    <th colspan="7">3er Periodo</th>
                    <th>NF</th> <!-- Columna de nota final con clase especial -->
                </tr>
                <tr>
                    <th></th>
                    <th class="nota">N1</th>
                    <th class="nota">0.35%</th>
                    <th class="nota">N2</th>
                    <th class="nota">0.35%</th>
                    <th class="nota">N3</th>
                    <th class="nota">0.30%</th>
                    <th class="nota nota-final">NP</th> <!-- Nota final del periodo con clase especial -->
                    <th class="nota">N1</th>
                    <th class="nota">0.35%</th>
                    <th class="nota">N2</th>
                    <th class="nota">0.35%</th>
                    <th class="nota">N3</th>
                    <th class="nota">0.30%</th>
                    <th class="nota nota-final">NP</th> <!-- Nota final del periodo con clase especial -->
                    <th class="nota">N1</th>
                    <th class="nota">0.35%</th>
                    <th class="nota">N2</th>
                    <th class="nota">0.35%</th>
                    <th class="nota">N3</th>
                    <th class="nota">0.30%</th>
                    <th class="nota nota-final">NP</th> <!-- Nota final del periodo con clase especial -->
                    <th class="nota-final">PF</th> <!-- Nota final general con clase especial -->
                </tr>
            </thead>
            <tbody>
                <?php
                    function obtenerNotas($conn, $nie, $materia, $periodo, $tipo_actividad) {
                        $consulta = "SELECT nota FROM notas WHERE nie = '$nie' AND materia = '$materia' AND periodo = '$periodo' AND tipo_actividad = '$tipo_actividad'";
                        $resultado = mysqli_query($conn, $consulta);
                        $totalNotas = 0;
                        $numeroNotas = 0;
                        while ($row = mysqli_fetch_array($resultado)) {
                            $totalNotas += $row['nota'];
                            $numeroNotas++;
                        }
                        return [$totalNotas, $numeroNotas];
                    }

                    function calcularPromedio($totalNotas, $numeroNotas) {
                        return $numeroNotas > 0 ? $totalNotas / $numeroNotas : "-";
                    }

                    function calcularNotaPeriodo($promedio, $peso) {
                        return $promedio !== "-" ? $promedio * $peso : "-";
                    }

                    function calcularNotas($conn, $nie, $materia, $periodo) {
                        $notas = [];
                        $tipos = ['cotidiana' => 0.35, 'integradora' => 0.35, 'examen' => 0.30];
                        foreach ($tipos as $tipo => $peso) {
                            list($totalNotas, $numeroNotas) = obtenerNotas($conn, $nie, $materia, $periodo, $tipo);
                            $promedio = calcularPromedio($totalNotas, $numeroNotas);
                            $notas[$tipo] = [
                                'promedio' => $promedio,
                                'nota_periodo' => calcularNotaPeriodo($promedio, $peso)
                            ];
                        }
                        return $notas;
                    }

                    $consulta = "SELECT cod_materia FROM maestros_materias WHERE dui_maestro = '$dui'";
                    $resultado = mysqli_query($conn, $consulta);
                    if (mysqli_num_rows($resultado) > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $materia = $row["cod_materia"];
                            echo "<tr><td>{$materia}</td>";

                            $promedios = [];
                            for ($periodo = 1; $periodo <= 3; $periodo++) {
                                $periodoStr = $periodo . 'PER';
                                $notas = calcularNotas($conn, $nie, $materia, $periodoStr);
                                
                                // Mostrar los promedios y notas del periodo o "-"
                                $promedioCotidiana = $notas['cotidiana']['promedio'];
                                $notaCotidiana = $notas['cotidiana']['nota_periodo'];
                                $promedioIntegradora = $notas['integradora']['promedio'];
                                $notaIntegradora = $notas['integradora']['nota_periodo'];
                                $promedioExamen = $notas['examen']['promedio'];
                                $notaExamen = $notas['examen']['nota_periodo'];
                                
                                // Calcular el promedio total si no hay "-"
                                $promedioTotal = ($notaCotidiana !== "-" && $notaIntegradora !== "-" && $notaExamen !== "-") ? 
                                    $notaCotidiana + $notaIntegradora + $notaExamen : "-";
                                
                                echo "<td>{$promedioCotidiana}</td>";
                                echo "<td>{$notaCotidiana}</td>";
                                echo "<td>{$promedioIntegradora}</td>";
                                echo "<td>{$notaIntegradora}</td>";
                                echo "<td>{$promedioExamen}</td>";
                                echo "<td>{$notaExamen}</td>";
                                echo "<td class='nota-final'>{$promedioTotal}</td>"; // Fondo amarillo para NP

                                $promedios[] = $promedioTotal;
                            }

                            // Calcular la nota final (NF) solo si no hay ningún "-"
                            $notaFinal = in_array("-", $promedios) ? "-" : array_sum($promedios) / count($promedios);
                            echo "<td class='nota-final'>{$notaFinal}</td></tr>"; // Fondo amarillo para NF
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
