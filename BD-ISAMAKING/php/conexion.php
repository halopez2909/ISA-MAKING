<?php

$server ="localhost"; 
$user = "root";
$pass = "";
$db ="isamaking";

    $conexion = new mysqli($server, $user, $pass, $db, 3300);

if ($conexion->connect_errno) {
    die("Conexion Fallida" . $conexion->connect_errno);
} else{
    echo "finalizado";
}

?>