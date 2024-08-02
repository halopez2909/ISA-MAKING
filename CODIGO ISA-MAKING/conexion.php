<?php

$server ="localhost"; 
$user = "";
$pass = "";
$db ="";

$conexion = new msqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("Conexion Fallida" . $conexion->connect_errno);
} else{
    echo "conectado";
}

?>