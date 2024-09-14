
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


</style>

    <?php
        include("../php/connDB.php");
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $grado = $_POST["grado"];
            $materia = $_POST["materia"];
      $dui = $_SESSION["dui"];
    $consulta= "SELECT * FROM alumnos ";
    $resultado = mysqli_query($conn, $consulta);
    if(mysqli_num_rows($resultado)> 0){
        $resultado = mysqli_fetch_assoc($resultado);
        $nombre = $resultado["nombre"];
        $apellidos = $resultado["apellidos"];
    }
    ?>
    <div class="alert alert-success" role="alert" style="width: 100%; text-align:center; padding: 5px; margin-top: 20px; ">
                    Datos cargados correctamente <h5>Tabla de Lugares de: <?php echo $grado." ".$materia; ?></h5>
                    </div>
<div class="ml-5 mr-5 mt-5">
    <div class="table-responsive">

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Materia</th>
                    <th colspan="7" >1er Periodo</th>
                    <th colspan="7">2do Periodo</th>
                    <th colspan="7">3er Periodo</th>
                    <th>NF</th>
                </tr>
                
                <tr>
                <th></th>
                <th class="nota">N1</th>
                <th class="nota">0.35%</th>
                <th class="nota">N2</th>
                <th class="nota">0.35%</th>
                <th class="nota">N3</th>
                <th class="nota">0.30%</th>
                <th class="nota">NP</th>
                <th class="nota">N1</th>
                <th class="nota">0.35%</th>
                <th class="nota">N2</th>
                <th class="nota">0.35%</th>
                <th class="nota">N3</th>
                <th class="nota">0.30%</th>
                <th class="nota">NP</th>
                <th class="nota">N1</th>
                <th class="nota">0.35%</th>
                <th class="nota">N2</th>
                <th class="nota">0.35%</th>
                <th class="nota">N3</th>
                <th class="nota">0.30%</th>
                <th class="nota">NP</th>
                <th class="nota">PF</th>
                </tr>
                </thead>

            <tbody>
                <?php
                    $consulta = "SELECT * FROM alumnos WHERE grado = '$grado' ORDER BY apellidos ";
                    $resultado = mysqli_query($conn, $consulta);
                    if(mysqli_num_rows($resultado) > 0){
                        while($row = mysqli_fetch_assoc($resultado)){
                            $nie = $row["nie"];
                            $nombre = $row["nombre"];
                            $apellidos = $row["apellidos"]
                                ?>
                                <tr>
                                <td><?php echo $row["apellidos"]. ", ". $row["nombre"]?></td>





                                
                                <?php


//====================================================================================================================================================================
//INICIO PRIMER PERIODO


                                //PRIMER PERIODO COTIDIANAS
                            $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '1PER' AND grado='$grado' AND tipo_actividad='cotidiana'";
                            $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                            $totalNotas = 0;
                            $numeroNotas = 0;
                            if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                    // Asumiendo que tienes un campo 'nota' en tu tabla
                                    $nota = $row['nota'];
                                    $totalNotas += $nota;
                                    // Contamos la cantidad de notas
                                    $numeroNotas++;

                                    
                                }
                                if ($numeroNotas > 0) {
                                    // Calculamos el promedio
                                    $promedio = $totalNotas / 5;
                                    $cotidiana = $promedio*0.35 ;
                                    ?>
                                <td><?php echo $promedio; ?></td>
                                <td><?php echo $cotidiana; ?></td>
                               
                                    <?php

                                } else {

                                }
                            } else {

                            }

                            //FIN PRIMER PERIODO COTIDIANAS



//====================================================================================================================================================================


                             //PRIMER PERIODO INTEGRADORA
                             $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '1PER' AND grado='$grado' AND tipo_actividad='integradora'";
                             $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                             $totalNotas = 0;
                             $numeroNotas = 0;
                             if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                 while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                     // Asumiendo que tienes un campo 'nota' en tu tabla
                                     $nota = $row['nota'];
                                     $totalNotas += $nota;
                                     // Contamos la cantidad de notas
                                     $numeroNotas++;
 
                                     
                                 }
                                 if ($numeroNotas > 0) {
                                     // Calculamos el promedio
                                     $promedio = $totalNotas / 1;
                                     $integradora = $promedio*0.35 ;
                                     ?>
                                 <td><?php echo $promedio; ?></td>
                                 <td><?php echo $integradora; ?></td>
                                
                                     <?php
 
                                 } else {

                                 }
                             } else {

                             }
 
                             //FIN PRIMER PERIODO INTEGRADORA







//====================================================================================================================================================================


                             //PRIMER PERIODO EXAMEN
                             $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '1PER' AND grado='$grado' AND tipo_actividad='examen'";
                             $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                             $totalNotas = 0;
                             $numeroNotas = 0;
                             if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                 while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                     // Asumiendo que tienes un campo 'nota' en tu tabla
                                     $nota = $row['nota'];
                                     $totalNotas += $nota;
                                     // Contamos la cantidad de notas
                                     $numeroNotas++;
 
                                     
                                 }
                                 if ($numeroNotas > 0) {
                                     // Calculamos el promedio
                                     $promedio = $totalNotas / 1;
                                     $examen = $promedio*0.30 ;
                                     ?>
                                 <td><?php echo $promedio; ?></td>
                                 <td><?php echo $examen; ?></td>
                                <td><?php $prom1 = $cotidiana + $integradora + $examen; echo $prom1 ?></td>
                                     <?php
 
                                 } else {

                                 }
                             } else {

                             }

                         

















                             

















//====================================================================================================================================================================
//INICIO PRIMER PERIODO


                                //PRIMER PERIODO COTIDIANAS
                                $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '2PER' AND grado='$grado' AND tipo_actividad='cotidiana'";
                                $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                                $totalNotas = 0;
                                $numeroNotas = 0;
                                if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                    while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                        // Asumiendo que tienes un campo 'nota' en tu tabla
                                        $nota = $row['nota'];
                                        $totalNotas += $nota;
                                        // Contamos la cantidad de notas
                                        $numeroNotas++;
    
                                        
                                    }
                                    if ($numeroNotas > 0) {
                                        // Calculamos el promedio
                                        $promedio = $totalNotas / 5;
                                        $cotidiana = $promedio*0.35 ;
                                        ?>
                                    <td><?php echo $promedio; ?></td>
                                    <td><?php echo $cotidiana; ?></td>
                                   
                                        <?php
    
                                    } else {
    
                                    }
                                } else {
    
                                }
    
                                //FIN PRIMER PERIODO COTIDIANAS
    
    
    
    //====================================================================================================================================================================
    
    
                                 //PRIMER PERIODO INTEGRADORA
                                 $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '2PER' AND grado='$grado' AND tipo_actividad='integradora'";
                                 $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                                 $totalNotas = 0;
                                 $numeroNotas = 0;
                                 if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                     while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                         // Asumiendo que tienes un campo 'nota' en tu tabla
                                         $nota = $row['nota'];
                                         $totalNotas += $nota;
                                         // Contamos la cantidad de notas
                                         $numeroNotas++;
     
                                         
                                     }
                                     if ($numeroNotas > 0) {
                                         // Calculamos el promedio
                                         $promedio = $totalNotas / 1;
                                         $integradora = $promedio*0.35 ;
                                         ?>
                                     <td><?php echo $promedio; ?></td>
                                     <td><?php echo $integradora; ?></td>
                                    
                                         <?php
     
                                     } else {
    
                                     }
                                 } else {
    
                                 }
     
                                 //FIN PRIMER PERIODO INTEGRADORA
    
    
    
    
    
    
    
    //====================================================================================================================================================================
    
    
                                 //PRIMER PERIODO EXAMEN
                                 $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '2PER' AND grado='$grado' AND tipo_actividad='examen'";
                                 $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                                 $totalNotas = 0;
                                 $numeroNotas = 0;
                                 if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                     while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                         // Asumiendo que tienes un campo 'nota' en tu tabla
                                         $nota = $row['nota'];
                                         $totalNotas += $nota;
                                         // Contamos la cantidad de notas
                                         $numeroNotas++;
     
                                         
                                     }
                                     if ($numeroNotas > 0) {
                                         // Calculamos el promedio
                                         $promedio = $totalNotas / 1;
                                         $examen = $promedio*0.30 ;
                                         ?>
                                     <td><?php echo $promedio; ?></td>
                                     <td><?php echo $examen; ?></td>
                                    <td><?php $prom2 = $cotidiana + $integradora + $examen; echo $prom2 ?></td>

                                         <?php
     
                                     } else {
    
                                     }
                                 } else {
    
                                 }
    































//====================================================================================================================================================================
//INICIO PRIMER PERIODO


                                //PRIMER PERIODO COTIDIANAS
                                $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '3PER' AND grado='$grado' AND tipo_actividad='cotidiana'";
                                $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                                $totalNotas = 0;
                                $numeroNotas = 0;
                                if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                    while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                        // Asumiendo que tienes un campo 'nota' en tu tabla
                                        $nota = $row['nota'];
                                        $totalNotas += $nota;
                                        // Contamos la cantidad de notas
                                        $numeroNotas++;
    
                                        
                                    }
                                    if ($numeroNotas > 0) {
                                        // Calculamos el promedio
                                        $promedio = $totalNotas / 5;
                                        $cotidiana = $promedio*0.35 ;
                                        ?>
                                    <td><?php echo $promedio; ?></td>
                                    <td><?php echo $cotidiana; ?></td>
                                   
                                        <?php
    
                                    } else {
    
                                    }
                                } else {
    
                                }
    
                                //FIN PRIMER PERIODO COTIDIANAS
    
    
    
    //====================================================================================================================================================================
    
    
                                 //PRIMER PERIODO INTEGRADORA
                                 $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '3PER' AND grado='$grado' AND tipo_actividad='integradora'";
                                 $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                                 $totalNotas = 0;
                                 $numeroNotas = 0;
                                 if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                     while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                         // Asumiendo que tienes un campo 'nota' en tu tabla
                                         $nota = $row['nota'];
                                         $totalNotas += $nota;
                                         // Contamos la cantidad de notas
                                         $numeroNotas++;
     
                                         
                                     }
                                     if ($numeroNotas > 0) {
                                         // Calculamos el promedio
                                         $promedio = $totalNotas / 1;
                                         $integradora = $promedio*0.35 ;
                                         ?>
                                     <td><?php echo $promedio; ?></td>
                                     <td><?php echo $integradora; ?></td>
                                    
                                         <?php
     
                                     } else {
    
                                     }
                                 } else {
    
                                 }
     
                                 //FIN PRIMER PERIODO INTEGRADORA
    
    
    
    
    
    
    
    //====================================================================================================================================================================
    
    
                                 //PRIMER PERIODO EXAMEN
                                 $consultaPrimerTrimestre = "SELECT * FROM notas WHERE nie='$nie' AND materia = '$materia' AND periodo = '3PER' AND grado='$grado' AND tipo_actividad='examen'";
                                 $resultadoPrimerTrimestre = mysqli_query($conn, $consultaPrimerTrimestre);
                                 $totalNotas = 0;
                                 $numeroNotas = 0;
                                 if(mysqli_num_rows($resultadoPrimerTrimestre) > 0){
                                     while($row = mysqli_fetch_array($resultadoPrimerTrimestre)){
                                         // Asumiendo que tienes un campo 'nota' en tu tabla
                                         $nota = $row['nota'];
                                         $totalNotas += $nota;
                                         // Contamos la cantidad de notas
                                         $numeroNotas++;
     
                                         
                                     }
                                     if ($numeroNotas > 0) {
                                         // Calculamos el promedio
                                         $promedio = $totalNotas / 1;
                                         $examen = $promedio*0.30 ;
                                         ?>
                                     <td><?php echo $promedio; ?></td>
                                     <td><?php echo $examen; ?></td>
                                    <td><?php $prom3 = $cotidiana + $integradora + $examen; echo $prom3 ?></td>
                                    <td><?php $totalPromedios = $prom1 + $prom2 + $prom3; echo $totalPromedios/3; ?></td>
                                         <?php
     
                                     } else {
    
                                     }
                                 } else {
    
                                 }
    
                        }
                        
                    }
                }
                ?>
                </tr>
            
            </tbody>

            </table>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>