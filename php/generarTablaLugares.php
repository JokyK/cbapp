<?php
include("../php/connDB.php");

function obtenerPromedio($nie, $materia, $grado, $periodo, $tipo_actividad, $conn, $factor) {
    $consulta = "SELECT nota FROM notas WHERE nie='$nie' AND materia='$materia' AND periodo='$periodo' AND grado='$grado' AND tipo_actividad='$tipo_actividad'";
    $resultado = mysqli_query($conn, $consulta);
    $totalNotas = 0;
    $numeroNotas = 0;

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $totalNotas += $row['nota'];
            $numeroNotas++;
        }

        if ($numeroNotas > 0) {
            return ($totalNotas / $numeroNotas) * $factor;
        }
    }
    return "-"; // Si no hay notas, retornamos "-"
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grado = $_POST["grado"];
    $materia = $_POST["materia"];

    $consulta = "SELECT * FROM alumnos WHERE grado = '$grado' ORDER BY apellidos";
    $resultado = mysqli_query($conn, $consulta);

    $estudiantes = []; // Array para almacenar estudiantes y sus notas finales

    if (mysqli_num_rows($resultado) > 0) {
        echo '<div class="alert alert-success" role="alert" style="width: 100%; text-align:center; padding: 5px; margin-top: 20px;">
                Datos cargados correctamente <h5>Tabla de Lugares de: ' . $grado . " " . $materia . '</h5></div>';
        
        // Campo de búsqueda
        echo '<input type="text" id="searchInput" class="search-input" placeholder="Buscar por NIE, Apellidos o Nombres..." style="width: 100%; margin-bottom: 10px; padding: 8px; font-size: 16px;">';

        echo '<div class="ml-5 mr-5 mt-5"><div class="table-responsive">';
        echo '<table class="table table-striped table-bordered" id="tablaAlumnos">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th colspan="7">1er Periodo</th>
                        <th colspan="7">2do Periodo</th>
                        <th colspan="7">3er Periodo</th>
                        <th>NF</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th >N1</th><th >0.35%</th><th >N2</th><th >0.35%</th><th >N3</th><th >0.30%</th><th class="nota-final">NP</th>
                        <th >N1</th><th >0.35%</th><th >N2</th><th >0.35%</th><th >N3</th><th >0.30%</th><th class="nota-final">NP</th>
                        <th >N1</th><th >0.35%</th><th >N2</th><th >0.35%</th><th >N3</th><th >0.30%</th><th class="nota-final">NP</th>
                        <th class="nota-final">PF</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($resultado)) {
            $nie = $row["nie"];
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];

            echo '<tr><td>' . $apellidos . ', ' . $nombre . '</td>';

            $totalPromedios = 0;
            for ($i = 1; $i <= 3; $i++) {
                $periodo = $i . "PER";

                // Obtener las notas de cada tipo de actividad
                $cotidiana = obtenerPromedio($nie, $materia, $grado, $periodo, 'cotidiana', $conn, 0.35);
                $integradora = obtenerPromedio($nie, $materia, $grado, $periodo, 'integradora', $conn, 0.35);
                $examen = obtenerPromedio($nie, $materia, $grado, $periodo, 'examen', $conn, 0.30);

                // Calcular el promedio del periodo
                $promedioPeriodo = ($cotidiana !== "-" && $integradora !== "-" && $examen !== "-") ? ($cotidiana + $integradora + $examen) : "-";
                $totalPromedios += ($promedioPeriodo !== "-") ? $promedioPeriodo : 0;

                // Mostrar las notas en la tabla
                echo '<td >' . ($cotidiana !== "-" ? number_format($cotidiana / 0.35, 2) : '-') . '</td>
                      <td >' . ($cotidiana !== "-" ? number_format($cotidiana, 2) : '-') . '</td>';
                echo '<td >' . ($integradora !== "-" ? number_format($integradora / 0.35, 2) : '-') . '</td>
                      <td >' . ($integradora !== "-" ? number_format($integradora, 2) : '-') . '</td>';
                echo '<td >' . ($examen !== "-" ? number_format($examen / 0.30, 2) : '-') . '</td>
                      <td >' . ($examen !== "-" ? number_format($examen, 2) : '-') . '</td>';
                echo '<td class="nota-final">' . ($promedioPeriodo !== "-" ? number_format($promedioPeriodo, 2) : '-') . '</td>';
            }

            // Calcular la nota final
            $notaFinal = ($totalPromedios > 0) ? number_format($totalPromedios / 3, 4) : '-';

            // Agregar al array de estudiantes
            if ($notaFinal !== '-') {
                $estudiantes[] = [
                    'nombre' => $apellidos . ', ' . $nombre,
                    'notaFinal' => $notaFinal
                ];
            }

            // Mostrar la nota final en la tabla
            echo '<td class="nota-final">' . ($notaFinal !== '-' ? $notaFinal : '-') . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table></div></div>';
        
        // Ordenar los estudiantes por nota final en orden descendente
        usort($estudiantes, function($a, $b) {
            return $b['notaFinal'] <=> $a['notaFinal'];
        });

        // Mostrar los primeros 3 lugares
        echo '<div class="alert alert-warning" role="alert" style="text-align:center; margin-top: 20px;">';
        echo '<h5>Top 3 Estudiantes - Grado: ' . $grado . ' - Materia: ' . $materia . '</h5>';
        for ($i = 0; $i < min(3, count($estudiantes)); $i++) {
            echo '<p>' . ($i + 1) . 'er Lugar: ' . $estudiantes[$i]['nombre'] . ' - Nota Final: ' . $estudiantes[$i]['notaFinal'] . '</p>';
        }
        echo '</div>';
    }
}
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    table {
        text-align: center;
    }

    input {
        width: 100%;
        font-size: 16px;
    }

    .num {
        width: 10px;
        border-radius: 4px;
        border: 1px solid black;
        background-color: white;
        padding: 2px;
        text-align: center;
    }

    td a {
        border-radius: 4px;
        padding: 7px 10px;
    }

    td a:hover {
        filter: brightness(.92);
    }

    .search-input {
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
        font-size: 16px;
    }

    /* Estilos para la nota final de cada periodo y la nota final general */
    .nota-final {
        background-color: #ffff99;
        font-weight: bold;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Función de búsqueda en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaAlumnos tbody tr');
        
        rows.forEach(function(row) {
            var alumno = row.cells[0].textContent.toLowerCase(); // Combina NIE, nombre y apellidos
            
            if (alumno.includes(input)) {
                row.style.display = ''; // Mostrar fila
            } else {
                row.style.display = 'none'; // Ocultar fila
            }
        });
    });
</script>
