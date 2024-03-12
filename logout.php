<?php
session_start();

if (isset($_POST['logout'])) {
    // Eliminar todas las variables de sesión
    session_unset();
    
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al usuario a la página de inicio de sesión u otra página
    header('Location: index.php');
    exit;
}
?>