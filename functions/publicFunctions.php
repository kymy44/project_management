<?php
function getFirstArrayElementAsString($array) {
    // Verificar si el array no está vacío
    if (!empty($array)) {
        // Obtener el primer elemento del array y convertirlo a string
        $firstElement = reset($array);
        $str = strval($firstElement);
        return $str;
    } else {
        // Si el array está vacío, devolver un mensaje indicando que el array está vacío
        return false;
    }
}

function IsAuthenticated(){
	if ($_SESSION['login']==true){
		return true;
	}
	else{
		return false;
	}
}

function getCurrentUserData(){
    if (isset($_SESSION['userId'])){
        $userData['id']=$_SESSION['userId'];
    }
    if (isset($_SESSION['userJob'])){
        $userData['job']=$_SESSION['userJob'];
    }
    return $userData;
}
?>