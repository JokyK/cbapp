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
</style>

<div class="ml-5 mr-5 mt-5">
    <!-- Campo de búsqueda -->
    <input type="text" id="searchInput" class="search-input" placeholder="Buscar por NIE, Apellidos o Nombres...">
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="alumnosTable">
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
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $numLista++;
                        ?>
                        <tr>
                            <td class="num"><?php echo $numLista ?></td>
                            <td class="num"><?php echo $row["nie"] ?></td>
                            <td><?php echo $row["apellidos"] ?></td>
                            <td><?php echo $row["nombre"] ?></td>
                            <td>
                                <a href="libreta.php?nie=<?php echo $row["nie"] ?>" class="link-primary">
                                    <i class="fa-solid fa-eye"></i> LIBRETA
                                </a>
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

<script>
    // Función para buscar en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var rows = document.querySelectorAll('#alumnosTable tbody tr');
        
        rows.forEach(function(row) {
            var nie = row.cells[1].textContent.toLowerCase();
            var apellidos = row.cells[2].textContent.toLowerCase();
            var nombres = row.cells[3].textContent.toLowerCase();
            
            if (nie.includes(input) || apellidos.includes(input) || nombres.includes(input)) {
                row.style.display = ''; // Mostrar fila
            } else {
                row.style.display = 'none'; // Ocultar fila
            }
        });
    });
</script>