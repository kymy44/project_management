<?php
session_start();
$_SESSION['login']='';
require_once('../functions/publicFunctions.php');
require_once('../model/connection.php');
require_once('../view/templates/header.php');
require_once('../view/login_view.php');
require_once('../model/login_model.php');

echo isset($_SESSION['loginError']) && $_SESSION['loginError'] ? 'Login incorrecto' : ''; //muestra mensaje de error de login

if (isset($_POST['username'])&&isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userId = checkLogin($pdo,$username,$password);
    echo $userId;
    if (!empty($userId)) {
        $userJob = getUserJob($pdo,$userId);
        $_SESSION['userId']=$userId;
        $_SESSION['userJob']=$userJob;
        $_SESSION['login'] = true;  //login correcto
        header('location: ../index.php');    
    }
}else{
    $_SESSION['loginError'] = true; //marcamos el login como incorrecto para que aparezca el mensaje cuando se recargue la página
}


require_once('../view/templates/footer.php');
?>