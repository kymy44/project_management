<form action="../logout.php" method="POST"> <!--borrar tras movver a la vvista-->
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
<?php

require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');
echo $header;

require_once('../model/projects_model.php');

$userData=getCurrentUserData();
//añadir redirección si no se tienen permisos

if ($userData['job']=='administrator'||$userData['job']=='coordinator'){
    if (isset($_POST['action'])&&$_POST['action']=='create'){
        $newProject = getProjectFormData();
        createProject($pdo,$newProject);
    }
}

if ($userData['job']=='administrator'){
    echo $usersButton;
    $projects = getAllProjects($pdo);
    require_once('../view/project_admin_view.php');

}else 
if ($userData['job']=='coordinator'){
    $projects = getCurrentUserProjects($pdo, $userData);
    require_once('../view/projects_view.php');

}else{
    echo 'No tienes permisos para entrar en esta página';
}
echo $goBackButton;
echo $logoutButton;
require_once('../view/templates/footer.php');
?>