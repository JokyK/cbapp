<?php
include("../php/connDB.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $grado = $_POST["grado"];
    $materia = $_POST["materia"];
    $periodo = $_POST["periodo"];

    foreach ($_POST['cotidiana'] as $nie => $actividades) {
        foreach ($actividades as $actividad => $nota) {
            if ($nota !== '') {
                // Verificar si ya existe la nota para el alumno y la actividad
                $sqlCheck = "SELECT id FROM notas WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo' AND tipo_actividad='cotidiana' AND nombre_actividad='$actividad'";
                $resultCheck = mysqli_query($conn, $sqlCheck);

                if (mysqli_num_rows($resultCheck) > 0) {
                    // Si existe, actualizar la nota
                    $sql = "UPDATE notas SET nota='$nota' WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo' AND tipo_actividad='cotidiana' AND nombre_actividad='$actividad'";
                } else {
                    // Si no existe, insertar una nueva nota
                    $sql = "INSERT INTO notas (nie, grado, materia, periodo, tipo_actividad, nombre_actividad, nota) 
                            VALUES ('$nie', '$grado', '$materia', '$periodo', 'cotidiana', '$actividad', '$nota')";
                }
                mysqli_query($conn, $sql);
            }
        }
    }

    foreach ($_POST['integradora'] as $nie => $actividades) {
        foreach ($actividades as $actividad => $nota) {
            if ($nota !== '') {
                $sqlCheck = "SELECT id FROM notas WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo' AND tipo_actividad='integradora' AND nombre_actividad='$actividad'";
                $resultCheck = mysqli_query($conn, $sqlCheck);

                if (mysqli_num_rows($resultCheck) > 0) {
                    $sql = "UPDATE notas SET nota='$nota' WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo' AND tipo_actividad='integradora' AND nombre_actividad='$actividad'";
                } else {
                    $sql = "INSERT INTO notas (nie, grado, materia, periodo, tipo_actividad, nombre_actividad, nota) 
                            VALUES ('$nie', '$grado', '$materia', '$periodo', 'integradora', '$actividad', '$nota')";
                }
                mysqli_query($conn, $sql);
            }
        }
    }

    foreach ($_POST['examen'] as $nie => $actividades) {
        foreach ($actividades as $actividad => $nota) {
            if ($nota !== '') {
                $sqlCheck = "SELECT id FROM notas WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo' AND tipo_actividad='examen' AND nombre_actividad='$actividad'";
                $resultCheck = mysqli_query($conn, $sqlCheck);

                if (mysqli_num_rows($resultCheck) > 0) {
                    $sql = "UPDATE notas SET nota='$nota' WHERE nie='$nie' AND grado='$grado' AND materia='$materia' AND periodo='$periodo' AND tipo_actividad='examen' AND nombre_actividad='$actividad'";
                } else {
                    $sql = "INSERT INTO notas (nie, grado, materia, periodo, tipo_actividad, nombre_actividad, nota) 
                            VALUES ('$nie', '$grado', '$materia', '$periodo', 'examen', '$actividad', '$nota')";
                }
                mysqli_query($conn, $sql);
            }
        }
    }
}

header("Location: ../main/notas.php");
exit();