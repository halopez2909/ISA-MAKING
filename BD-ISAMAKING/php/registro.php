<?php 
    include("conexion.php");

    if(isset($_POST['registro'])){
        $nombre = trim($_POST['name']);
        $email = trim($_POST['username']);
        $telefono = trim($_POST['teluser']);
        $clave = trim($_POST['password']);
    }

    if(empty($nombre) || empty($email) || empty($telefono) || empty($clave)){
    echo '<h3 class="error_login">Por favor llene todos los campos. </h3>';
    } else{
        $clave = trim($_POST['password']);
        $hashed_pass = password_hash($clave, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `cliente`( `nombre`, `email`, `telefono`, `clave`) VALUES ('$nombre', '$email', '$telefono', '$hashed_pass')";
        $resultado = mysqli_query($conexion, $sql);
       


        if ($resultado) {
            echo '<h3 class="cuenta_creada">¡Felicidades, has creado tu cuenta!.</h3>';
            header("location: ../HTMLS/index.html");
        } else {
            echo '<h3 class="cuenta_error">Ocurrió un error durante el registro.</h3>';
        }
    }

    $conexion->close();
?>