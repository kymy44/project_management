<form action="../logout.php" method="POST"> <!-- borrar tras mover a la vista -->
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
<?php

require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');
echo $header;

require_once('../model/projects_model.php');

$userData = getCurrentUserData();
$projectId = $_POST['projectId'];
$projectDetails = getProjectDetails($pdo, $projectId);
// añadir redirección si no se tienen permisos

if ($userData['job'] == 'administrator' || $userData['job'] == 'coordinator') {
    // DELETE
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        deleteProject($pdo, $projectId);
        header('location: projects_controller.php');
    }
    // UPDATE
    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $projectDetails = getProjectFormData();
        if (!empty($projectDetails)) {
            updateProject($pdo, $projectId, $projectDetails);
            // Recargar los detalles del proyecto actualizado
            $projectDetails = getProjectDetails($pdo, $projectId);
        } else {
            echo 'error al actualizar, problema con los datos del formulario';
        }
    }
    $projectDetails = getProjectDetails($pdo, $projectId);
    require_once('../view/project_detail_view.php');
} else {
    echo 'No tienes permisos para entrar en esta página';
}

echo $goBackButton;
echo $logoutButton;
require_once('../view/templates/footer.php');

?>
