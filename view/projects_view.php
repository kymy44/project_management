<form action="tasks_controller.php" method="post">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <!-- Barra antes de la primera tarea -->
                    <br><br>
                    <hr class="my-4 barras">
                    <?php
                    // y las listamos en un foreach
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
            </div>
        </div>
    </div>
</form>

<form action="projects_controller.php" method="post">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="name">Nombre del proyecto:</label>
                <input type="text" id="name" name="name" class="form-control" required><br>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description" class="form-control" required></textarea><br>
                
                <input type="hidden" name="coordinator_id" value="<?php echo $_SESSION['userId']; ?>">
                
                <input type="submit" name="action" value="create" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
