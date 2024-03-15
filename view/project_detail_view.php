<form action="projects_detail_controller.php" method="post">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="name">Nombre del proyecto:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($projectDetails['name']); ?>"><br>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($projectDetails['description']); ?></textarea><br>

                <?php if ($_SESSION['userJob'] === 'administrator'): ?>
                    <label for="coordinator_id">ID del coordinador:</label>
                    <input type="text" id="coordinator_id" name="coordinator_id" class="form-control" value="<?php echo htmlspecialchars($projectDetails['coordinator_id']); ?>"><br>
                <?php else: ?>
                    <input type="hidden" name="coordinator_id" value="<?php echo htmlspecialchars($projectDetails['coordinator_id']); ?>">
                <?php endif; ?>

                <input type="hidden" name="projectId" value="<?php echo htmlspecialchars($projectId); ?>">
                <input type="submit" name="action" value="update" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>

<form method="post" action="projects_detail_controller.php">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <button type="submit" name="action" value="delete" class="btn btn-danger">Eliminar</button>
                <input type="hidden" name="projectId" value="<?php echo htmlspecialchars($projectId); ?>">
            </div>
        </div>
    </div>
</form>
