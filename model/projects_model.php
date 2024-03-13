<?php

session_start();
require_once('connection.php');
require_once('../functions/publicFunctions.php');
$userData=getCurrentUserData();

function getCurrentUserProjects($pdo,$userData){
    try {
        $sql = "SELECT id, name, description FROM projects WHERE coordinator_id = :coorId";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':coorId' => $userData['id']));

        // Obtener todas las filas como un array de arrays asociativos
        $projects = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $projects;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}
function getAllProjects($pdo){
    try {
        $sql = "SELECT projects.id as id, name, description, users.username as coordinatorName FROM projects INNER JOIN users ON projects.coordinator_id = users.id;";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute();

        // Obtener todas las filas como un array de arrays asociativos
        $projects = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $projects;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function getProjectDetails($pdo,$projectId){
    
}
?>