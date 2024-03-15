<?php
function getAllUsers($pdo) {
    $sql = "SELECT * FROM users";
    $statement = $pdo->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function addUser($pdo, $userData) {
    try {
        $sql = "INSERT INTO users (username, full_name, last_name, job_id, password_hash) 
                VALUES (:username, :fullName, :lastName, :jobId, :passwordHash)";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':username' => $userData['username'],
            ':fullName' => $userData['full_name'],
            ':lastName' => $userData['last_name'],
            ':jobId' => $userData['job_id'],
            ':passwordHash' => $userData['password']
        ]);

        // Devolver true
        return true;
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al insertar el nuevo usuario: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function checkJobExists($pdo, $jobId) {
    try {
        $sql = "SELECT COUNT(*) FROM job_positions WHERE id = :jobId";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':jobId' => $jobId));

        // Obtener el resultado
        $count = $statement->fetchColumn();

        return $count > 0;
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al verificar la existencia de la job_id: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}


function deleteUser($pdo, $userId)
{
    try {
        // Preparar la consulta SQL para eliminar el usuario
        $sql = "DELETE FROM users WHERE id = :userId";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute([':userId' => $userId]);

        // Verificar si se eliminó correctamente
        return $statement->rowCount() > 0;
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al eliminar el usuario: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}









?>

