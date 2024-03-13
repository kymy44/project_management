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
//añadir redirección si no se tienen permisos


$projects = getCurrentUserProjects($pdo, $userData);
require_once('../view/projects_view.php');

if ($userData['job']='administrator'){
    echo $viewUserManagementButton;
}

?>