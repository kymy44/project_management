<form action="../logout.php" method="POST"> <!--borrar tras movver a la vvista-->
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
<?php
session_start();
require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');

require_once('../model/tasks_model.php');
$userData=getCurrentUserData();
echo $_SESSION['userJob'];
echo $_SESSION['userId'];
//añadir redirección si no se tienen permisos

if($userData['job']=='staff'){
    echo 'mostrar lista de tareas';
    $userTasks = getCurrentUserTasks($pdo,$userData);
    require_once('../view/tasks_staff_view.php');
}

if(isset($_POST['projectId'])){
    $projectId = $_POST['projectId'];
    echo 'el post va, has clickado en el proyecto '.$_POST['projectId'];
}