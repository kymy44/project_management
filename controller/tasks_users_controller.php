<?php
session_start();
require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');
echo $header;
require_once('../model/tasks_model.php');

$userData = getCurrentUserData();

// Comprobamos roles de administrador o coordinador
if ($userData['job'] == 'administrator' || $userData['job'] === 'coordinator') {    
    // Verificar si se ha enviado el ID de la tarea
    if(!isset($_POST['taskId'])){ 
        echo 'error al obtener la ID de la tarea';
    }
    $taskId = $_POST['taskId'];
    $taskUsers = getAssignedUsersForTask($pdo,$taskId);
    $staffUsers = getStaffUsers($pdo);
    echo 'la tarea es '.$taskId;
    // Actualizar usuarios asignados a la tarea
    if(isset($_POST['updateUsers'])){
        // Verificar si se recibieron usuarios asignados
        if (isset($_POST['assignedUsers']) && is_array($_POST['assignedUsers'])) {
            // Obtener los IDs de los usuarios seleccionados
            $selectedUsers = $_POST['assignedUsers'];
            assignUsersToTask($pdo,$taskId,$selectedUsers);
        }

        echo 'Usuarios seleccionados: ';
        foreach ($selectedUsers as $userId) {
            echo $userId . ', ';
        }
    }
    require_once('../view/tasks_users_view.php');
} else {
    echo 'no deberías estar aquí';
}


echo $goBackButton;
echo $logoutButton;
require_once('../view/templates/footer.php');
?>
