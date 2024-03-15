<h1>User Management</h1>
<a href="users_controller.php?action=add">Add User</a>
<table border="1">
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
                <button type="submit" name="action" value="delete">borrar</button>
              </form>
              <form action="users_controller.php" method="POST">
                <button type="submit" name="action" value="detail">editar</button>
              </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<form action="users_controller.php" method="POST">
  <label for="username">Nombre de usuario:</label>
  <input type="text" id="username" name="username" required><br>

  <label for="fullName">Nombre completo:</label>
  <input type="text" id="fullName" name="full_name" required><br>

  <label for="lastName">Apellido:</label>
  <input type="text" id="lastName" name="last_name" required><br>

  <label for="jobId">ID del puesto:</label>
  <input type="text" id="jobId" name="job_id" required><br>

  <label for="password">Contraseña:</label>
  <input type="password" id="password" name="password" required><br>

  <input type="submit" name="action" value="add">
</form>





<button onclick="goBack()" class="btn btn-secondary">Volver Atrás</button>

<script>
function goBack() {
  window.history.back();
}
</script>