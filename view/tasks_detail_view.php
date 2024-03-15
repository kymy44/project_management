<form action="tasks_controller.php" method="post">
    <label for="name">Nombre de la tarea:</label>
    <input type="text" id="name" name="name" placeholder="<?php echo $taskDetails['name']; ?>"><br>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" placeholder="<?php echo $taskDetails['description']; ?>"></textarea><br>

    <label for="start_date">Fecha de inicio:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $taskDetails['start_date']; ?>"><br>

    <label for="deadline">Fecha límite:</label>
    <input type="date" id="deadline" name="deadline" value="<?php echo $taskDetails['deadline']; ?>"><br>

    <input type="hidden" name="taskId" value="<?php echo $taskId; ?>">


    <input type="submit" name="action" value="update" class="btn btn-primary">

</form>

<form method="post" action="tasks_controller.php">
    <button type="submit" name="action" value="delete" class="btn btn-danger">Eliminar</button>
    <input type="hidden" name="taskId" value="<?php echo $taskId?>">
</form>

<form action="tasks_controller.php" method="post">
    <?php foreach ($assignedUsers as $user): ?>
        <label>
            <input type="checkbox" name="assigned_users[]" value="<?php echo $user['id']; ?>"
                   <?php if ($user['assigned']) echo 'checked'; ?>>
            <?php echo $user['username']; ?>
        </label><br>
    <?php endforeach; ?>
    <input type="hidden" name="taskId" value="<?php echo $taskId; ?>">
    <input type="submit" value="Actualizar">
</form>




<button onclick="goBack()" class="btn btn-secondary">Volver Atrás</button>
<script>
function goBack() {
  window.history.back();
}
</script>