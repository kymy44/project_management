

<?php


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

function getCurrentProjectTasks($pdo,$projectId){
    try {
        $sql = "SELECT id, name, description, start_date, deadline FROM tasks where project_id = :id";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute([':id' => $projectId]);

        // Obtener todas las filas como un array de arrays asociativos
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $tasks;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function getCurrentTaskDetails($pdo, $taskId){
    try {
        $sql = "SELECT name, description, start_date, deadline FROM tasks WHERE id = :id";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute([':id' => $taskId]);

        // Obtener la primera fila como un array asociativo
        $taskDetails = $statement->fetch(PDO::FETCH_ASSOC);
        return $taskDetails;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function updateTask($pdo, $taskId, $taskData) {
    try {
        $sql = "UPDATE tasks SET name = :name, description = :description, start_date = :start_date, deadline = :deadline WHERE id = :id";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(
            ':name' => $taskData['name'],
            ':description' => $taskData['description'],
            ':start_date' => $taskData['start_date'],
            ':deadline' => $taskData['deadline'],
            ':id' => $taskId
        ));

        // Devolver true si la actualización fue exitosa
        return true;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al actualizar la tarea: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function getTaskFormData() {
    $taskData = array();

    // Verificar si se enviaron los datos del formulario
    if(isset($_POST['name'], $_POST['description'], $_POST['start_date'], $_POST['deadline'])) {
        // Verificar que ninguno de los campos esté vacío
        if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['start_date']) && !empty($_POST['deadline'])) {
            $taskData['name'] = $_POST['name'];
            $taskData['description'] = $_POST['description'];
            $taskData['start_date'] = $_POST['start_date'];
            $taskData['deadline'] = $_POST['deadline'];
        } else {
            // si falta algun campo devolvemos array vacío.
            return $taskData;
        }
    }
    return $taskData;
}
function deleteTask($pdo, $taskId) {
    try {
        $sql = "DELETE FROM tasks WHERE id = :id";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':id' => $taskId));

        return true;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al eliminar la tarea: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function getProjectIdFromTaskId($pdo, $taskId) {
    try {
        $sql = "SELECT project_id FROM tasks WHERE id = :taskId";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':taskId' => $taskId));

        // Obtener la fila asociada a la tarea
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['project_id'];
        } else {
            return null; // Devolver null si la tarea no se encontró
        }

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al obtener la ID del proyecto: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}


function checkProjectExists($pdo, $projectId)
{
    try {
        $sql = "SELECT COUNT(*) AS count FROM projects WHERE id = :projectId";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute([':projectId' => $projectId]);

        // Obtener el resultado
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al verificar si el proyecto existe: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function createTask($pdo, $taskDetails, $projectId)
{
    try {
        // Verificar si el proyectoexiste
        $projectExists = checkProjectExists($pdo, $projectId);

        if (!$projectExists) {
            echo 'El proyecto asociado no existe.';
            return false;
        }

        $sql = "INSERT INTO tasks (name, description, start_date, deadline, project_id) VALUES (:name, :description, :start_date, :deadline, :project_id)";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':name' => $taskDetails['name'],
            ':description' => $taskDetails['description'],
            ':start_date' => $taskDetails['start_date'],
            ':deadline' => $taskDetails['deadline'],
            ':project_id' => $projectId
        ]);

        // Devolver true si la inserción fue exitosa
        return true;
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al insertar la nueva tarea: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}


function getAssignedUsersForTask($pdo, $taskId)
{
    try {
        // Consulta SQL para obtener los usuarios asignados a la tarea
        $sql = "SELECT u.id, u.username,
                       CASE WHEN ut.task_id IS NOT NULL THEN 1 ELSE 0 END AS assigned
                FROM users u
                LEFT JOIN users_tasks ut ON u.id = ut.user_id AND ut.task_id = :taskId
                WHERE job_id=2"; //esto hará que solo saque el staff
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute([':taskId' => $taskId]);

        // Obtener los resultados como un array asociativo
        $assignedUsers = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $assignedUsers;
    } catch (PDOException $e) {
        // Manejar cualquier excepción y mostrar un mensaje de error
        echo 'Error al obtener los usuarios asignados: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function updateAssignedUsers($pdo, $taskId, $assignedUsers) {
    try {
        // Eliminar todas las asignaciones existentes para esta tarea
        $sqlDelete = "DELETE FROM users_tasks WHERE task_id = :taskId";
        $statementDelete = $pdo->prepare($sqlDelete);
        $statementDelete->execute([':taskId' => $taskId]);

        // Insertar las nuevas asignaciones
        $sqlInsert = "INSERT INTO users_tasks (user_id, task_id) VALUES (:userId, :taskId)";
        $statementInsert = $pdo->prepare($sqlInsert);
        foreach ($assignedUsers as $userId) {
            $statementInsert->execute([':userId' => $userId, ':taskId' => $taskId]);
        }

        return true; // Devolver true si se actualizan las asignaciones correctamente
    } catch (PDOException $e) {
        // Manejar cualquier error de base de datos
        echo 'Error al actualizar las asignaciones: ' . $e->getMessage();
        return false; // Devolver false si ocurre un error
    }
}


