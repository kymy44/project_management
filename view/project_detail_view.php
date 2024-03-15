<form action="projects_detail_controller.php" method="post">
    <label for="name">Nombre del proyecto:</label>
    <input type="text" id="name" name="name" placeholder="<?php echo $projectDetails['name']; ?>"><br>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" placeholder="<?php echo $projectDetails['description']; ?>"></textarea><br>

    <label for="coordinator_id">ID del coordinador:</label>
    <input type="text" id="coordinator_id" name="coordinator_id" value="<?php echo $projectDetails['coordinator_id']; ?>"><br>

    <input type="hidden" name="projectId" value="<?php echo $projectId; ?>">

    <input type="submit" name="action" value="update" class="btn btn-primary">
</form>

<form method="post" action="projects_detail_controller.php">
    <button type="submit" name="action" value="delete" class="btn btn-danger">Eliminar</button>
    <input type="hidden" name="projectId" value="<?php echo $projectId; ?>">
</form>

<button onclick="goBack()" class="btn btn-secondary">Volver Atrás</button>

<script>
function goBack() {
  window.history.back();
}
</script>

