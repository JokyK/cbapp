<?php
include("../php/connDB.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $grado = $_POST["grado"];
    $materia = $_POST["materia"];
    $periodo = $_POST["periodo"];
    if ($grado != "" && $materia != "" && $periodo != "") {
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="alert alert-success" role="alert" style="width: 100%; text-align:center; padding: 5px; margin-top: 20px; ">
    Datos cargados correctamente <h5>Grado: <?php echo $grado . ", Materia: " . $materia . ", Periodo: " . $periodo; ?></h5>
</div>
<div class="ml-5 mr-5 mt-5">
    <div class="table-responsive">
        <form id="notasForm" method="POST" action="../php/guardar_notas.php">
            <input type="hidden" name="grado" value="<?php echo htmlspecialchars($grado); ?>">
            <input type="hidden" name="materia" value="<?php echo htmlspecialchars($materia); ?>">
            <input type="hidden" name="periodo" value="<?php echo htmlspecialchars($periodo); ?>">
            <button type="submit" class="btn btn-primary mb-2" style="color: white;"> <i class="fa-solid fa-floppy-disk"></i> Guardar Notas</button>

            <div class="form-group">
                <label for="searchInput">Buscar Alumno:</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o apellidos">
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="alumno">N°</th>
                        <th class="alumno">Alumno</th>
                        <th colspan="5" class="cotidiana">Actividad Cotidiana 35%</th>
                        <th class="cotidiana td-cotidiana">Prom. Cot</th>
                        <th class="integradora">Actividad Integradora 35%</th>
                        <th class="integradora td-integradora">Prom. Int</th>
                        <th class="examen">Examen 30%</th>
                        <th class="examen td-examen">Prom. Exa</th>
                        <th class="promfin">Prom. Final</th>
                    </tr>
                    <tr>
                        <th class="alumno"></th>
                        <th class="alumno"></th>
                        <th class="cotidiana">Cuaderno</th>
                        <th class="cotidiana">Tareas</th>
                        <th class="cotidiana">Libro</th>
                        <th class="cotidiana">1°Examen</th>
                        <th class="cotidiana">2°Examen</th>
                        <th class="cotidiana  td-cotidiana">%</th>
                        <th class="integradora">Integradora</th>
                        <th class="integradora td-integradora">%</th>
                        <th class="examen">Examen Trimestral</th>
                        <th class="examen td-examen">%</th>
                        <th class="promfin"></th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                    <?php
                    $sql = "SELECT nie, apellidos, nombre FROM alumnos WHERE grado='$grado' ORDER BY apellidos";
                    $buscar = mysqli_query($conn, $sql);

                    if ($buscar) {
                        $numeroLista = 0;
                        while ($row = mysqli_fetch_assoc($buscar)) {
                            $numeroLista++;
                            $nie = $row["nie"];
                            $nombreCompleto = htmlspecialchars($row["apellidos"] . ", " . $row["nombre"]);

                            // Obtener notas existentes
                            $cotidianas = [];
                            $integradoras = [];
                            $examenes = [];

                            $sqlNotas = "SELECT * FROM notas WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo'";
                            $resultNotas = mysqli_query($conn, $sqlNotas);

                            while ($nota = mysqli_fetch_assoc($resultNotas)) {
                                if ($nota['tipo_actividad'] == 'cotidiana') {
                                    $cotidianas[$nota['nombre_actividad']] = $nota['nota'];
                                } elseif ($nota['tipo_actividad'] == 'integradora') {
                                    $integradoras[$nota['nombre_actividad']] = $nota['nota'];
                                } elseif ($nota['tipo_actividad'] == 'examen') {
                                    $examenes[$nota['nombre_actividad']] = $nota['nota'];
                                }
                            }
                    ?>
                            <tr>
                                <td class="alumno"><?php echo $numeroLista; ?></td>
                                <td class="alumno">
                                    <input type="hidden" class="nombre" value="<?php echo $nombreCompleto; ?>">
                                    <input type="text" class="nombre-input" value="<?php echo $nombreCompleto; ?>" readonly>
                                </td>

                                <!-- ACTIVIDADES COTIDIANAS -->
                                <?php
                                $actividadesCotidianas = ['Cuaderno', 'Tareas', 'Libro', '1°Examen', '2°Examen'];
                                $promCotidianas = 0;
                                foreach ($actividadesCotidianas as $actividad) {
                                    $nota = isset($cotidianas[$actividad]) ? $cotidianas[$actividad] : '';
                                    $promCotidianas += $nota ? $nota : 0;
                                    echo '<td class="cotidiana"><input class="nota" type="number" name="cotidiana[' . $nie . '][' . $actividad . ']" value="' . htmlspecialchars($nota) . '" min="0" max="10" step="0.01" onchange="calcularPromedios(this)"></td>';
                                }
                                $promCotidianas = $promCotidianas / count($actividadesCotidianas);
                                echo '<td class="cotidiana td-cotidiana"><input class="nota promedio-cotidiana" type="number" value="' . number_format($promCotidianas * 0.35, 2) . '" readonly></td>';
                                ?>

                                <!-- ACTIVIDAD INTEGRADORA -->
                                <?php
                                $promIntegradoras = 0;
                                $notaIntegradora = isset($integradoras['Integradora']) ? $integradoras['Integradora'] : '';
                                $promIntegradoras += $notaIntegradora ? $notaIntegradora : 0;
                                echo '<td class="integradora"><input class="nota" type="number" name="integradora[' . $nie . '][Integradora]" value="' . htmlspecialchars($notaIntegradora) . '" min="0" max="10" step="0.01" onchange="calcularPromedios(this)"></td>';
                                echo '<td class="integradora td-integradora"><input class="nota promedio-integradora" type="number" value="' . number_format($promIntegradoras * 0.35, 2) . '" readonly></td>';
                                ?>

                                <!-- EXAMEN -->
                                <?php
                                $promExamen = 0;
                                $notaExamen = isset($examenes['Examen Trimestral']) ? $examenes['Examen Trimestral'] : '';
                                $promExamen += $notaExamen ? $notaExamen : 0;
                                echo '<td class="examen"><input class="nota" type="number" name="examen[' . $nie . '][Examen Trimestral]" value="' . htmlspecialchars($notaExamen) . '" min="0" max="10" step="0.01" onchange="calcularPromedios(this)"></td>';
                                echo '<td class="examen td-examen"><input class="nota promedio-examen" type="number" value="' . number_format($promExamen * 0.30, 2) . '" readonly></td>';
                                ?>

                                <!-- PROMEDIO FINAL -->
                                <?php
                                $promFinal = ($promCotidianas * 0.35) + ($promIntegradoras * 0.35) + ($promExamen * 0.30);
                                echo '<td class="promfin"><input class="nota promedio-final" type="number" value="' . number_format($promFinal, 2) . '" readonly></td>';
                                ?>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='13'>Error en la consulta de la base de datos.</td></tr>";
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
    function calcularPromedios(input) {
        var row = input.closest('tr');

        // Calcular promedio de actividades cotidianas
        var cotidianas = row.querySelectorAll('input[name^="cotidiana"]');
        var sumCotidianas = 0;
        cotidianas.forEach(function (input) {
            sumCotidianas += parseFloat(input.value) || 0;
        });
        var promCotidianas = (sumCotidianas / cotidianas.length) * 0.35;
        row.querySelector('.promedio-cotidiana').value = promCotidianas.toFixed(2);

        // Calcular promedio de actividad integradora
        var integradora = parseFloat(row.querySelector('input[name^="integradora"]').value) || 0;
        var promIntegradoras = integradora * 0.35;
        row.querySelector('.promedio-integradora').value = promIntegradoras.toFixed(2);

        // Calcular promedio de examen
        var examen = parseFloat(row.querySelector('input[name^="examen"]').value) || 0;
        var promExamen = examen * 0.30;
        row.querySelector('.promedio-examen').value = promExamen.toFixed(2);

        // Calcular promedio final
        var promFinal = promCotidianas + promIntegradoras + promExamen;
        row.querySelector('.promedio-final').value = promFinal.toFixed(2);
    }

    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableBody tr").filter(function() {
                var nombre = $(this).find(".nombre").val().toLowerCase();
                $(this).toggle(nombre.indexOf(value) > -1);
            });
        });
    });
</script>

<?php
    } else {
?>
<div class="alert alert-warning" role="alert" style="width: 100%; text-align:center; padding: 5px; margin-top: 20px; ">
    ¡Ingresa primero:
    -Grado
    -Materia
    -Periodo!

    Para poder generar la tabla!
</div>
<?php
    }
}
?>
