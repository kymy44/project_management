<form action="../logout.php" method="POST"> <!--borrar tras movver a la vvista-->
    <button type="submit" name="logout">Cerrar sesión</button>
</form>
<?php
session_start();
echo $_SESSION['userJob'];
echo $_SESSION['userId'];

require_once('../model/connection.php');
require_once('../model/users_model.php');

// Verificar el rol del usuario
if ($_SESSION['userJob'] !== 'administrator') {
    echo "Acceso denegado. Debes ser administrador.";
    exit;
}

// Acción por defecto
$action = isset($_POST['action']) ? $_POST['action'] : 'list';
echo $action;
switch ($action) {
    case 'list':
        // Mostrar lista de usuarios
        $users = getAllUsers($pdo);
        include('../view/users_view.php');
        break;
    
    case 'add':
            $newUser = [
                'username' => $_POST['username'],
                'full_name' => $_POST['full_name'],
                'last_name' => $_POST['last_name'],
                'job_id' => $_POST['job_id'],
                'password' => $_POST['password'] 
            ];
    
            // Verificar que todos los campos del formulario estén presentes
            if (empty($newUser['username']) || empty($newUser['full_name']) || empty($newUser['last_name']) || empty($newUser['job_id']) || empty($newUser['password'])) {
                echo "Hay que poner todos los campos";
                exit;
            }
    
            // Verificar que el job_id existe en la base de datos
            if (!checkJobExists($pdo, $newUser['job_id'])) {
                echo "El ID del ttrabajo no es válido.";
                exit;
            }
    
            // Insertar el nuevo usuario en la base de datos
            if (addUser($pdo, $newUser)) {
                echo "Usuario creado correctamente.";
            } else {
                echo "Error al crear el usuario.";
            }
        
        break;
    
    case 'edit':
        // Editar usuario
        // Código para editar un usuario existente
        break;
    
    case 'delete':
        $userId= $_POST['userId'];
        echo $userId;
        deleteUser($pdo,$userId);
        header('location: users_controller.php');
        break;
    
    default:
        echo "Acción no válida.";
        break;
}
?>
<button onclick="goBack()" class="btn btn-secondary">Volver Atrás</button>
<script>
function goBack() {
  window.history.back();
}
</script>
