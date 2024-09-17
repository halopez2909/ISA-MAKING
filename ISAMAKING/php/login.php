<?php
//conexion
    include('conexion.php');
    //
    session_start();
if(isset($_POST['login'])){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $mail = $_POST['email'];
            $pass = $_POST['password'];
            $query = $db->query("SELECT * FROM cliente WHERE email='$mail'");
            $resultado = $query;
            if ($resultado->num_rows == 1) {
            $usuario = mysqli_fetch_assoc($resultado);
            }
            if (password_verify($pass, $usuario['clave'])) {
                switch ($usuario['rol']){
                    case '1':
                        //administrador
                        echo '<script>
        alert ("Iniciaste Sesion Correctamente")
        window.location.href = "../HTMLS/administrador.html"
        </script>';
                        break;
                    case '2':
                        //usuario
                        echo '<script>
        alert ("Iniciaste Sesion Correctamente")
        window.location.href = "../HTMLS/index.html"
        </script>';
                        break;
            }
        }
          else {
            echo '<script>
        alert ("Usuario o contraseña incorrectos")
        window.location.href = "../HTMLS/inicioSesion.html"
        </script>';
        }
}
        else {
        echo '<script>
        alert ("Debes llenar todos los campos")
        window.location.href = "../HTMLS/inicioSesion.html"
        </script>';
        }
    }


?>