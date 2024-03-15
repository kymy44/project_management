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
                    Name: <?php echo $project['name']; ?> - Description: <?php echo $project['description']?>
                </span>
                <input type="hidden" name="action" value="ver">
                <hr class="my-4 barras">
               
            </li>
        <?php endforeach; ?>
    </ul>
</form>

<form action="projects_controller.php" method="post">
    <label for="name">Nombre del proyecto:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="coordinator_id">ID del coordinador:</label>
    <input type="number" id="coordinator_id" name="coordinator_id" required><br>

    <input type="submit" name="action" value="create" class="btn btn-primary">
</form>

<button onclick="goBack()" class="btn btn-secondary">Volver Atrás</button>

<script>
function goBack() {
  window.history.back();
}
</script>