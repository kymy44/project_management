

<?php

session_start();
require_once('connection.php');
require_once('../functions/publicFunctions.php');
$userData=getCurrentUserData();

function getCurrentUserTasks($pdo,$userData){
    try {
        $sql = "SELECT tasks.id as id, tasks.name as name, tasks.description, start_date, deadline , projects.name as project
        FROM tasks INNER JOIN users_tasks ON users_tasks.task_id = tasks.id JOIN projects on tasks.project_id = projects.id WHERE users_tasks.user_id=:userId;";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':userId' => $userData['id']));

        // Obtener todas las filas como un array de arrays asociativos
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $tasks;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}