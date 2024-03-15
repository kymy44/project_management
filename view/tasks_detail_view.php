<form action="tasks_controller.php" method="post">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="name">Nombre de la tarea:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="<?php echo $taskDetails['name']; ?>"><br>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description" class="form-control" placeholder="<?php echo $taskDetails['description']; ?>"></textarea><br>

                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $taskDetails['start_date']; ?>"><br>

                <label for="deadline">Fecha límite:</label>
                <input type="date" id="deadline" name="deadline" class="form-control" value="<?php echo $taskDetails['deadline']; ?>"><br>

                <input type="hidden" name="taskId" value="<?php echo $taskId; ?>">

                <input type="submit" name="action" value="update" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>

<form method="post" action="tasks_controller.php">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <button type="submit" name="action" value="delete" class="btn btn-danger">Eliminar</button>
                <input type="hidden" name="taskId" value="<?php echo $taskId?>">
            </div>
        </div>
    </div>
</form>

<form method="post" action="tasks_users_controller.php">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger">Usuarios</button>
                <input type="hidden" name="taskId" value="<?php echo $taskId?>">
            </div>
        </div>
    </div>
</form>
