<form action="../logout.php" method="POST"> <!--borrar tras movver a la vvista-->
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
<?php
session_start();
echo $_SESSION['userJob'];
echo $_SESSION['userId'];
//añadir redirección si no se tienen permisos
?>