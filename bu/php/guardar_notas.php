<?php
include("../php/connDB.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grado = $_POST['grado'];
    $periodo = $_POST['periodo'];
    $materia = $_POST['materia'];
    $nombresCotidianas = $_POST['nombresCotidianas'];
    $nombresIntegradoras = $_POST['nombresIntegradoras'];
    $data = $_POST['data'];

    foreach ($data as $nie => $notas) {
        // Guardar notas de actividades cotidianas
        foreach ($notas['cotidianas'] as $index => $nota) {
            $nombreActividad = $nombresCotidianas[$index];
            $sql = "INSERT INTO notas (nie, grado, materia, periodo, tipo_actividad, nombre_actividad, nota)
                    VALUES ('$nie', '$grado', '$materia', '$periodo', 'Cotidiana', '$nombreActividad', '$nota')";
            mysqli_query($conn, $sql);
        }

        // Guardar notas de actividades integradoras
        foreach ($notas['integradoras'] as $index => $nota) {
            $nombreActividad = $nombresIntegradoras[$index];
            $sql = "INSERT INTO notas (nie, grado, materia, periodo, tipo_actividad, nombre_actividad, nota)
                    VALUES ('$nie', '$grado', '$materia', '$periodo', 'Integradora', '$nombreActividad', '$nota')";
            mysqli_query($conn, $sql);
        }

        // Guardar nota de examen
        $examen = $notas['examen'];
        $sql = "INSERT INTO notas (nie, grado, materia, periodo, tipo_actividad, nombre_actividad, nota)
                VALUES ('$nie', '$grado', '$materia', '$periodo', 'Examen', 'Examen Final', '$examen')";
        mysqli_query($conn, $sql);

        // Guardar promedio final
        $promFinal = $notas['promFinal'];
        $sql = "INSERT INTO notas (nie, grado, materia, periodo, tipo_actividad, nombre_actividad, nota)
                VALUES ('$nie', '$grado', '$materia', '$periodo', 'Promedio', 'Promedio Final', '$promFinal')";
        mysqli_query($conn, $sql);
    }

    echo "Notas guardadas exitosamente.";
}
?>