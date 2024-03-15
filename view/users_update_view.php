<form action="users_controller.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder="<?php echo $userData['username']; ?>" class="form-control" required><br>

    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" placeholder="<?php echo $userData['full_name']; ?>" class="form-control" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" placeholder="<?php echo $userData['last_name']; ?>" class="form-control" required><br>

    <label for="job_id">Job ID:</label>
    <input type="number" id="job_id" name="job_id" placeholder="<?php echo $userData['job_id']; ?>" class="form-control" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" class="form-control" required><br>

    <input type="hidden" name="userId" value="<?php echo $userData['id']; ?>">

    <input type="submit" name="action" value="update" class="btn btn-primary">
</form>

