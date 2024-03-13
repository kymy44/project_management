<form action="tasks_controller.php" method="post">
    <ul class="list-unstyled">
        <!-- Barra antes de la primera tarea -->
        <br><br>
        <hr class="my-4 barras">
        <?php
        // Verificar si hay tareas para mostrar
        if ($userTasks) {
            // Iterar sobre cada tarea y mostrar los detalles en el formulario
            foreach ($userTasks as $task): ?>
                <li class="text-center">
                    <button type="submit" name="taskId" value="<?php echo $task['id']; ?>" class="invisible-button">
                        <?php echo 'ID: '.$task['id']; ?>
                    </button>
                    <br> 
                    <span class="tarea-info">
                        Name: <?php echo $task['name']; ?> - Description: <?php echo $task['description']?> - Project: <?php echo $task['project']?> - Start Date: <?php echo $task['start_date']?> - Deadline: <?php echo $task['deadline']?>
                    </span>
                    <input type="hidden" name="action" value="ver">
                    <hr class="my-4 barras">
                </li>
            <?php endforeach;
        } else {
            echo '<li>No hay tareas disponibles.</li>';
        }
        ?>
    </ul>
</form>