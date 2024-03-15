<form action="../logout.php" method="POST"> <!--borrar tras movver a la vvista-->
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
<?php

require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');

require_once('../model/projects_model.php');
echo $_SESSION['userJob'];
echo $_SESSION['userId'];
echo 'el proyecto es ';
echo $_POST['projectId'];
$userData=getCurrentUserData();
$projectId = $_POST['projectId'];
$projectDetails = getProjectDetails($pdo,$projectId);
//añadir redirección si no se tienen permisos



if ($userData['job']=='administrator'||$userData['job']=='coordinator'){
    
    
    //DELETE
    if (isset($_POST['action'])&&$_POST['action']=='delete'){
        deleteProject($pdo,$projectId);
        header('location: projects_controller.php');
    }
    //UPDATE
    if (isset($_POST['action']) && $_POST['action']=='update') {
        echo 'updatepro';
        $projectDetails = getProjectFormData();
        if (!empty($projectDetails)){

            updateProject($pdo, $projectId, $projectDetails);
            // Recargar los detalles de la tarea actualizada
            $projectDetails = getProjectDetails($pdo, $projectId);
            echo 'actualizacion correcta';
        } else{
            echo 'error al actualizar, problema con los datos del formulario';
        }
    }
    $projectDetails = getProjectDetails($pdo, $projectId);
    require_once('../view/project_detail_view.php');
}else{
    echo 'No tienes permisos para entrar en esta página';
}


?>