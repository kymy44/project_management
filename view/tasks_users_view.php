<?php
// Verificamos si se obtuvieron usuarios asignados
if ($taskUsers !== false) {
    // Comprobamos si hay usuarios asignados
    //if (!empty($taskUsers)) {
        echo '<form action="" method="post" class="container-fluid">';
        echo '<h3 class="bg-dark text-center text-white py-2">Usuarios Staff</h3>';
        echo '<ul class="list-unstyled">';
        foreach ($staffUsers as $user) {
            $isChecked = in_array($user['id'], array_column($taskUsers, 'id')) ? 'checked' : ''; // Verificar si el usuario está asignado a la tarea
            echo '<li class="py-1"><input type="checkbox" name="assignedUsers[]" value="' . $user['id'] . '" ' . $isChecked . '> ' . $user['username'] . '</li>';
        }
        echo '</ul>';
        echo '<input type="hidden" value="' . $taskId . '" name="taskId">'; // Corrección aquí
        echo '<input type="submit" value="Actualizar Usuarios" name="updateUsers" class="btn btn-outline-success mt-3">';
        echo '</form>';
    //} else {
      //  echo 'No hay usuarios asignados a esta tarea.';
    //}
} else {
    echo '<p class="text-danger">No se pudieron obtener los usuarios asignados.</p>';
}
?>
