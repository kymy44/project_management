<form action="users_controller.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder="<?php echo $user['username']; ?>" required><br>

    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" placeholder="<?php echo $user['full_name']; ?>" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" placeholder="<?php echo $user['last_name']; ?>" required><br>

    <label for="job_id">Job ID:</label>
    <input type="number" id="job_id" name="job_id" placeholder="<?php echo $user['job_id']; ?>" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">

    <input type="submit" name="action" value="update" class="btn btn-primary">
</form>
