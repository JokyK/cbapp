<?php
// logout.php
session_start();
session_unset(); // Limpiar todas las variables de sesión
session_destroy(); // Destruir la sesión
header("Location: ../main/index.php"); // Redirigir a la página de inicio de sesión
exit();
?>