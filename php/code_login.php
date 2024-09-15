<?php
include("connDB.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            // Prevenir inyecciones SQL
            $email = mysqli_real_escape_string($conn, $email);
        
            // Buscar al usuario en la base de datos
            $sql = "SELECT * FROM maestros WHERE correo = '$email' AND contrasena = '$password'";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                    $_SESSION["usuario"] = $row['correo'];
                    $_SESSION["dui"] = $row["dui"];
                    // La contraseña es correcta
                    echo "Inicio de sesión exitoso. ¡Bienvenido " . $_SESSION["usuario"] . "!";
                    header('location:../AppCB/main/dashboard.php');
                } else {
                    // Contraseña incorrecta
                    ?>
                    <div class="alert alert-danger" role="alert" style="width: 100%; text-align:center; padding: 5px; ">
                    ¡Email o contraseña incorrectos!
                    </div>
                    <?php
                }
            } 
        
        $conn->close();
        }

?>