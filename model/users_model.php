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

function getUserData($pdo, $userId) {
    try {
        // Preparar la consulta SQL para obtener los datos del usuario
        $sql = "SELECT * FROM users WHERE id = :userId";
        
        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':userId' => $userId));

        // Obtener los datos del usuario
        $userData = $statement->fetch(PDO::FETCH_ASSOC);

        return $userData;

    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al obtener los datos del usuario: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function getUserFormData() {
    // Verificar si se enviaron los datos del formulario por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si todos los campos requeridos tienen datos
        if (isset($_POST['username']) && isset($_POST['full_name']) && isset($_POST['last_name']) && isset($_POST['job_id']) && isset($_POST['password'])) {
            // Crear un array con los datos del usuario
            $userData = array(
                'username' => $_POST['username'],
                'full_name' => $_POST['full_name'],
                'last_name' => $_POST['last_name'],
                'job_id' => $_POST['job_id'],
                'password' => $_POST['password']
            );

            return $userData;
        } else {
            // Si falta algún campo requerido, mostrar un mensaje de error
            echo "Todos los campos son requeridos.";
            return null;
        }
    } else {
        // Si no se enviaron datos por POST, retornar null
        return null;
    }
}
function updateUser($pdo, $userData, $userId) {
    try {
        // Preparar la consulta SQL para actualizar el usuario
        $sql = "UPDATE users SET username = :username, full_name = :full_name, last_name = :last_name, job_id = :job_id, password_hash = :password WHERE id = :userId";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(
            ':username' => $userData['username'],
            ':full_name' => $userData['full_name'],
            ':last_name' => $userData['last_name'],
            ':job_id' => $userData['job_id'],
            ':password' => password_hash($userData['password'], PASSWORD_DEFAULT), // Hashear la contraseña antes de almacenarla
            ':userId' => $userId
        ));

        // Devolver true si la actualización fue exitosa
        return true;
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al actualizar el usuario: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}









?>

