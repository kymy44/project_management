<?php
require_once('connection.php');
require_once('../functions/publicFunctions.php');

function checkLogin($pdo,$username,$passwd){
    try {
        $sql = "SELECT id FROM users WHERE username = :username AND password_hash = :passwd";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':username' => $username , ':passwd' => $passwd));

        // Obtener la fila como un array asociativo
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        $result = getFirstArrayElementAsString($row);
        if (!empty($result)){
            return $result;
        }else{
            return '';
        }
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}

function getUserJob($pdo,$userId){
    try {
        $sql = "SELECT j.name from users u inner join job_positions j on j.id = u.job_id where u.id = :id";

        // Preparar y ejecutar la consulta
        $statement = $pdo->prepare($sql);
        $statement->execute(array(':id' => $userId));

        // Obtener la fila como un array asociativo
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $result= getFirstArrayElementAsString($row);
        return $result;
    } catch (PDOException $e) {
        // Capturar cualquier excepción y mostrar un mensaje de error
        echo 'Error al ejecutar la consulta: ' . $e->getMessage();
        return false; // Devolver false en caso de error
    }
}


?>