<form action="tasks_controller.php" method="post">
    <ul class="list-unstyled">
        <!-- Barra antes de la primera tarea -->
        <br><br>
        <hr class="my-4 barras">
        <?php
        

        //y las listamos en un foreach
        foreach ($projects as $project): ?>
            <li class="text-center">
                <button type="submit" name="projectId" value="<?php echo $project['id']; ?>" class="invisible-button">
                    <?php echo 'ID: '.$project['id']; ?>
                </button>
                <br> 
                <span class="tarea-info">
                    Name: <?php echo $project['name']; ?> - Description: <?php echo $project['description']?> - Coordinator: <?php echo $project['coordinatorName']?>
                </span>
                <input type="hidden" name="action" value="ver">
                <hr class="my-4 barras">
               
            </li>
        <?php endforeach; ?>
    </ul>
</form>