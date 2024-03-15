<h1 class="titulo">User Management</h1>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Last Name</th>
        <th>Job ID</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['full_name']; ?></td>
            <td><?php echo $user['last_name']; ?></td>
            <td><?php echo $user['job_id']; ?></td>
            <td>
              <form action="users_controller.php" method="POST">
                <input type="hidden" name="userId" value="<?php echo$user['id']?>">
                <button type="submit" name="action" value="delete" class="btn btn-danger botonElim">borrar</button>
              </form>
              <form action="users_controller.php" method="POST">
                <input type="hidden" name="userId" value="<?php echo$user['id']?>">
                <button type="submit" name="action" value="detail" class="btn btn-primary botonInfo">editar</button>
              </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="users_controller.php" method="POST">
  <div class="form-group">
    <label for="username">Nombre de usuario:</label>
    <input type="text" id="username" name="username" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="fullName">Nombre completo:</label>
    <input type="text" id="fullName" name="full_name" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="lastName">Apellido:</label>
    <input type="text" id="lastName" name="last_name" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="jobId">ID del puesto:</label>
    <input type="text" id="jobId" name="job_id" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>

  <input type="submit" name="action" value="add" class="btn btn-success">
</form>
