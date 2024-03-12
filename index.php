<?php
session_start();
//include('view/templates/header.php');
include('functions/publicFunctions.php');
//aqui se debe redirigir al login en caso de que no se esté logeado
//si estás logeado, debemos redirigir en funcion del rol
//admin:  gestion de proyectos, gestion de usuarios (redirigir desde un boton),
//coordinador: gestion de proyectos
//staff: ver tareas (un usuario staff solo tiene un unico proyecto)
if (IsAuthenticated()){
    //echo ' bien '; //aqui se redirige en función del rol
    //echo $_SESSION['userJob'];
    //echo $_SESSION['userId'];
    header ('location: test.php');
}else{
    header('location: controller/login_controller.php');
   }

//echo '<br>estas en el index';
//include('view/templates/footer.php');
?>