<ul class="list-unstyled">
    <!-- Barra antes de la primera tarea -->
    <br><br>
    <hr class="my-4 barras">
    <?php
    // Verificar si hay tareas para mostrar
    if ($userTasks) {
        // Iterar sobre cada tarea y mostrar los detalles en la lista
        foreach ($userTasks as $task): ?>
            <li class="text-center">
                <h3><?php echo $task['name']; ?></h3> <!-- Mostrar el nombre de la tarea en un título más grande -->
                <span class="tarea-info">
                    Description: <?php echo $task['description']; ?> - Project: <?php echo $task['project']; ?> - Start Date: <?php echo $task['start_date']; ?> - Deadline: <?php echo $task['deadline']; ?>
                </span>
                <hr class="my-4 barras">
            </li>
        <?php endforeach;
    } else {
        echo '<li>No hay tareas disponibles.</li>';
    }
    ?>
</ul>

