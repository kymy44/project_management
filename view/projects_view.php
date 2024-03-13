<h2>Project management</h2>
<?php
if ($projects !== false) {
    if (!empty($projects)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Description</th>';
        echo '</tr>';

        foreach ($projects as $project) {
            echo '<tr>';
            echo '<td>' . $project['id'] . '</td>';
            echo '<td>' . $project['name'] . '</td>';
            echo '<td>' . $project['description'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No projects found for this user.';
    }
} else {
    echo 'Error retrieving projects.';
}

$viewUserManagementButton = <<<HTML
    <form action="users_controller.php" method="GET">
        <button type="submit">User Management</button>
    </form>
HTML;
?>

