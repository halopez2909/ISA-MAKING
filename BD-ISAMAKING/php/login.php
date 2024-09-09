<?php
include("conexion.php");

if (isset($_POST['inicio_sesion'])) {
    if (strlen($_POST['username']) >= 1 && strlen($_POST['password']) >= 1) {
        $usuario = trim($_POST['username']);
        $contrasena = trim($_POST['password']);

        $stmt = $conex->prepare("SELECT `id_cliente`, `nombre``clave` FROM cliente WHERE nombre=?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id, $nombre, $hash_contrasena);

        if ($stmt->fetch()) {
            // Verificar la contraseña
            if (password_verify($contrasena, $hash_contrasena)) {
                $_SESSION['id'] = $id;
                $_SESSION['nombre'] = $nombre;
                header("location: ../index.html");
            } else {
                echo '<h3 class="cuenta_error">Contraseña incorrecta</h3>';
            }
        } else {
            echo '<h3 class="cuenta_error">Usuario no encontrado</h3>';
        }

        $stmt->close();
    } else {
        echo '<h3 class="cuenta_error">Por favor, completa todos los campos.</h3>';
    }
}
$conexion->close();
?>