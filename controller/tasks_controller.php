<?php
session_start();
require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');
echo $header;
require_once('../model/tasks_model.php');

$userData = getCurrentUserData();

// Guardar el ID del proyecto en la sesión si se ha enviado desde el formulario
if (isset($_POST['projectId'])) {
    $_SESSION['projectId'] = $_POST['projectId'];
}

if ($userData['job'] == 'staff') {
    // Mostrar las tareas del usuario si es personal
    $userTasks = getCurrentUserTasks($pdo, $userData);
    require_once('../view/tasks_staff_view.php');
} elseif ($userData['job'] == 'administrator' || $userData['job'] === 'coordinator') {
    // Comprobar roles de administrador y coordinador

    // CREAR TAREA
    if (isset($_POST['action']) && $_POST['action'] == 'create') {
        $projectId = $_SESSION['projectId'];
        $taskDetails = getTaskFormData();
        createTask($pdo, $taskDetails, $projectId);
        header('location: tasks_controller.php'); // Recargar la página para mostrar la nueva tarea
    }

    // DETALLES DE TAREA
    if (isset($_POST['taskId'])) {
        $taskId = $_POST['taskId'];
        if (isset($_POST['action']) && $_POST['action'] == 'tasksUsers') {
            header('location: tasks_users_controller.php');
        }
        
        // ELIMINAR TAREA
        if (isset($_POST['action']) && $_POST['action'] == 'delete') {
            deleteTask($pdo, $taskId);
            header('location: tasks_controller.php');
        }

        // ACTUALIZAR TAREA
        if (isset($_POST['action']) && $_POST['action'] == 'update') {
            $taskDetails = getTaskFormData();
            if (!empty($taskDetails)) {
                updateTask($pdo, $taskId, $taskDetails);
                // Recargar los detalles de la tarea actualizada
                $taskDetails = getCurrentTaskDetails($pdo, $taskId);
            } else {
                echo 'error al actualizar, problema con los datos del formulario';
            }
        }

        $taskDetails = getCurrentTaskDetails($pdo, $taskId);
        require_once('../view/tasks_detail_view.php');

    } else {
        // Mostrar tareas del proyecto
        $projectId = $_SESSION['projectId'];
        echo 'El formulario se ha enviado correctamente. Has seleccionado el proyecto ' . $_SESSION['projectId'];
        require_once('../view/tasks_view.php');
    }

} else {
    echo 'no deberías estar aquí';
}
echo $logoutButton;

echo $goBackButton;

require_once('../view/templates/footer.php');
?>
