<?php
session_start();
include('functions/publicFunctions.php');
$userData = getCurrentUserData();
echo 'estas en test';
echo $userData['id'];
echo $userData['job'];
//echo $_SESSION['userId'];
?>
<form action="logout.php" method="POST">
    <button type="submit" name="logout">Cerrar sesión</button>
</form>