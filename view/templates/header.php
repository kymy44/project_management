<?php $header=<<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Tareas CRUD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../view/assets/css/style.css">

</head>
<body>
    <!-- CABECERA -->

		<div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" aria-label="Custom navbar example">
            <img src="../view/assets/img/libro.jpg" alt="Bootstrap" width="30px" height="30px">
            <div class="navbar-brand mx-auto">Crud Tareas</div>
        </nav>
    </div>
<br>

HTML;
$logoutButton =<<<HTML
<form action="../logout.php" method="POST"> <!--borrar tras movver a la vvista-->
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
HTML;
$usersButton =<<<HTML
<form action="../controller/users_controller.php" method="POST"> <!--borrar tras movver a la vvista-->
    <button type="submit" name="users">Users</button>
</form>
HTML;

$goBackButton = <<<HTML
<button onclick="goBack()" class="btn btn-secondary fixed-button">Volver Atrás</button>
<script>
function goBack() {
  window.history.back();
}
</script>
HTML;


?>
