<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    table {
        text-align: center;
    }

    input {
        width: 100px;
        font-size: 12px;
    }

    .num {
        width: 10px;
        border-radius: 4px;
        border: 1px solid black;
        background-color: white;
        padding: 2px;
        text-align: center;
    }

    td a{
        background-color: rgb(255, 190, 100);;
        border-radius: 4px;
        padding: 7px 10px;
    }
    td a:hover{
        filter:brightness(.92);
    }
</style>

<div class="ml-5 mr-5 mt-5">
    <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Nie</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Acciones</th>
                </tr>
                
                </thead>

                <tbody>
                <?php
                $grado = $_GET["grado"];
                include("connDB.php");

                $consulta = "SELECT * FROM alumnos WHERE grado = '$grado' ORDER BY apellidos";   
                $result = mysqli_query($conn, $consulta);
                $numLista = 0;
                if(mysqli_num_rows($result)> 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $numLista++;
                        ?>
                        <tr>
                        <td class="num" ><?php echo $numLista ?></td>
                        <td class="num" ><?php echo $row["nie"]?></td>
                        <td><?php echo $row["apellidos"]?></td>
                        <td><?php echo $row["nombre"] ?></td>
                        <td>
                        <a href="libreta.php?nie=<?php echo $row["nie"]?>" class="link-light"><i class="fa-solid fa-clipboard"></i> LIBRETA</a>
                        </td>
        
                        </tr>

                        <?php

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