<form action="projects_detail_controller.php" method="POST">
    <button type="submit" name="projectId" value="<?php echo $projectId;?>" class="btn btn-primary">Modificar</button>
</form>

<form action="tasks_controller.php" method="post">
    <ul class="list-unstyled">
        <!-- Barra antes de la primera tarea -->
        <br><br>
        <hr class="my-4 barras">
        <?php
        $tasks = getCurrentProjectTasks($pdo, $projectId);

        // Verificar si se obtuvieron las tareas correctamente
        if ($tasks !== false) {
            if (!empty($tasks)){
                // Listar las tareas en un foreach
                foreach ($tasks as $task): ?>
                    <li class="text-center">
                        <button type="submit" name="taskId" value="<?php echo $task['id']; ?>" class="invisible-button">
                            <?php echo 'ID: '.$task['id']; ?>
                        </button>
                        <br> 
                        <span class="tarea-info">
                            Name: <?php echo $task['name']; ?> - Description: <?php echo $task['description']?> - Start Date: <?php echo $task['start_date']?> - Deadline: <?php echo $task['deadline']?>
                        </span>
                        <input type="hidden" name="action" value="ver">
                        <hr class="my-4 barras">
                    </li>
                <?php endforeach;
            }else{
                echo '<li class="text-center">No hay tareas en este proyecto</li>';
            }
        } else {
            // Mensaje si no se pudieron recuperar las tareas del proyecto
            echo '<li class="text-center">No se pudieron recuperar las tareas del proyecto.</li>';
        }
        ?>
    </ul>
</form>

<form action="tasks_controller.php" method="post">
    <label for="name">Nombre de la tarea:</label>
    <input type="text" id="name" name="name" placeholder="Nombre de la tarea" class="form-control"><br>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" placeholder="Descripción de la tarea" class="form-control"></textarea><br>

    <label for="start_date">Fecha de inicio:</label>
    <input type="date" id="start_date" name="start_date" value="" class="form-control"><br>

    <label for="deadline">Fecha límite:</label>
    <input type="date" id="deadline" name="deadline" value="" class="form-control"><br>

    <input type="submit" name="action" value="create" class="btn btn-primary">
</form>

