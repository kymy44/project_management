<?php 
$vista = '
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="login_controller.php" method="POST">
        <div class="form-group">
          <label for="username">Nombre de usuario:</label>
          <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
      </form>
    </div>
  </div>
</div>';
?>
