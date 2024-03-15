<?php
// Conectando a la db
$connection = 'mysql:host=localhost;dbname=project_management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($connection, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
    exit;
}
?>