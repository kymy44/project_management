<?php
session_start();
require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');

require_once('../model/tasks_model.php');
$userData=getCurrentUserData();
echo $_SESSION['userJob'];
echo $_SESSION['userId'];
echo $logoutButton;
if (isset($_POST['projectId'])){ //esto está muy feo pero es lo único que se me ocurre, porque al enviar el form de creación de tarea se pierde el post con el ID del proyecto
    $_SESSION['projectId']=$_POST['projectId'];
}

if($userData['job']=='staff'){ //mostrar las tareas del usuario si es staff
    echo 'mostrar lista de tareas';
    $userTasks = getCurrentUserTasks($pdo,$userData);
    require_once('../view/tasks_staff_view.php');






}else if($userData['job'] == 'administrator' || $userData['job'] === 'coordinator'){    //comprobamos roles
    
   
    if (isset($_POST['action']) && $_POST['action']=='create') {//CREATE
        $projectId = $_SESSION['projectId'];
        echo $projectId;
        $taskDetails=getTaskFormData();
        createTask($pdo,$taskDetails,$projectId);
        header('location: tasks_controller.php'); //recargamos la pagina para que aparezca la nueva tarea (está feo)
    }
    
    
    








    if (isset($_POST['taskId'])){//comprobamos si se clickó en una tarea
        $taskId = $_POST['taskId'];
        echo 'detalles tarea //'.$taskId;


        $assignedUsers= getAssignedUsersForTask($pdo,$taskId);

        if (isset($_POST['assigned_users'])) {
            $taskId = $_POST['taskId'];
            $newAssignedUsers = $_POST['assigned_users'];
            updateAssignedUsers($pdo, $taskId, $newAssignedUsers);
            //header('tasks_controller.php');
        }



        //DELETE
    if (isset($_POST['action']) && $_POST['action']=='delete') {
        deleteTask($pdo,$taskId);
        echo 'El formulario se ha enviado correctamente. Has seleccionado el proyecto '.$projectId;
        header('location: tasks_controller.php');
    }        



    //UPDATE
    if (isset($_POST['action']) && $_POST['action']=='update') {
        $taskDetails = getTaskFormData();
        if (!empty($taskDetails)){


            
            updateTask($pdo, $taskId, $taskDetails);
            // Recargar los detalles de la tarea actualizada
            $taskDetails = getCurrentTaskDetails($pdo, $taskId);
            echo 'actualizacion correcta';
        } else{
            echo 'error al actualizar, problema con los datos del formulario';
        }
    }

    $taskDetails = getCurrentTaskDetails($pdo, $taskId);

    foreach ($taskDetails as $key => $value) {
        echo "$key: $value<br>";
    





    $taskDetails = getCurrentTaskDetails($pdo, $taskId);

    require_once('../view/tasks_detail_view.php');
    }

    
    
    
    
    
    
    
    
    
    
    }else{ 
        

        //mostramos tareas del proyecto
        $projectId = $_SESSION['projectId'];
        echo 'El formulario se ha enviado correctamente. Has seleccionado el proyecto '.$_SESSION['projectId'];
        require_once('../view/tasks_view.php');
    }
}else {
    echo 'no deberias estar aqui';
}
