<?php

session_start();
require_once('connection.php');
require_once('../functions/publicFunctions.php');


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


function getProjectDetails($pdo, $projectId) {
    try {
        // Preparar la consulta SQL para obtener los detalles del proyecto
        $sql = "SELECT name, description, coordinator_id FROM projects WHERE id = :projectId";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':projectId' => $projectId));

        $projectDetails = $statement->fetch(PDO::FETCH_ASSOC);

        return $projectDetails;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al obtener los detalles del proyecto: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function deleteProject($pdo, $projectId) {
    try {
        // Preparar la consulta SQL para borrar el proyecto
        $sql = "DELETE FROM projects WHERE id = :projectId";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':projectId' => $projectId));

        // Devolver true si se borra correctamente
        return true;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al borrar el proyecto: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}
function getProjectFormData() {
    $projectData = array();
    // Verificar si se enviaron todos los datos del formulario
    if(isset($_POST['name'], $_POST['description'], $_POST['coordinator_id'])) {
        // Verificar que ninguno de los campos esté vacío
        if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['coordinator_id'])) {
            // Recoger los datos del formulario y colocarlos en un array
            $projectData['name'] = $_POST['name'];
            $projectData['description'] = $_POST['description'];
            $projectData['coordinator_id'] = $_POST['coordinator_id'];
        }
    }
    return $projectData;
}
function updateProject($pdo, $projectId, $projectData) {
    try {
        // Preparar la consulta SQL para actualizar los campos del proyecto
        $sql = "UPDATE projects SET name = :name, description = :description, coordinator_id = :coordinator_id WHERE id = :id";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(
            ':name' => $projectData['name'],
            ':description' => $projectData['description'],
            ':coordinator_id' => $projectData['coordinator_id'],
            ':id' => $projectId
        ));

        // Devolver true si la actualización fue exitosa
        return true;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al actualizar el proyecto: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function verifyCoordinatorId($pdo, $coordinator_id) {
    try {
        // Preparar la consulta SQL para verificar la existencia del coordinador
        $sql = "SELECT COUNT(*) 
        FROM users 
        INNER JOIN job_positions ON users.job_id = job_positions.id 
        WHERE users.id = :coordinator_id AND job_positions.name IN ('coordinator')";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':coordinator_id' => $coordinator_id));

        // Obtener el resultado de la consulta
        $count = $statement->fetchColumn();

        // Devolver true si el coordinador existe, de lo contrario false
        return $count > 0;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al verificar la existencia del coordinador: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function createProject($pdo, $projectData) {
    // Verificar si el coordinador existe
    if (!verifyCoordinatorId($pdo, $projectData['coordinator_id'])) {
        echo 'El coordinador no ees válido.';
        return false;
    }

    // Intentar insertar el proyecto
    try {
        // Preparar la consulta SQL para insertar un nuevo proyecto
        $sql = "INSERT INTO projects (name, description, coordinator_id) VALUES (:name, :description, :coordinator_id)";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(
            ':name' => $projectData['name'],
            ':description' => $projectData['description'],
            ':coordinator_id' => $projectData['coordinator_id']
        ));

        // Devolver true si la inserción fue exitosa
        return true;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al insertar el proyecto: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}
?>
