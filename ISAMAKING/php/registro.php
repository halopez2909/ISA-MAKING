<?php
include("conexion.php");
session_start();

if(isset($_POST['registro'])){

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['teluser'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $hash = password_hash($pass, PASSWORD_DEFAULT, [50]);
    $tel = $_POST['teluser'];
    $sql = "SELECT * FROM cliente WHERE email='$email'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo '<script>
        alert ("El correo ya existe")
        window.location.href = "../HTMLS/registro.html"
        </script>';
    } else {
        $insertar = "INSERT INTO cliente (nombre, email, telefono, clave, rol)VALUES ('$name', '$email', '$tel', '$hash','2')";
    }
    if ($db->query($insertar)) {
        echo '<script>
        alert ("Registro Exitoso")
        window.location.href = "../HTMLS/inicioSesion.html"
        </script>';
    }
} else {
        echo '<script>
        alert ("Completar Todos Los Campos")
        window.location.href = "../HTMLS/registro.html"
        </script>';
}
}
?>