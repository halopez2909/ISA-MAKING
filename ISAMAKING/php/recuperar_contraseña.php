<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "isamaking");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el email existe en la base de datos
    $query = "SELECT * FROM cliente WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));

        // Almacenar el token en la base de datos
        $query = "INSERT INTO recuperaciones (email, token) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $email, $token);
        $stmt->execute();

        // Configurar PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambia esto al host de tu servidor SMTP55
            $mail->SMTPAuth = true;
            $mail->Username = 'al405727@gmail.com'; // Cambia esto a tu dirección de email
            $mail->Password = 'ggdt fgxy sfgm apoa'; // Cambia esto a tu contraseña
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Configuración del email electrónico
            $mail->setFrom('al405727@gmail.com', 'CDMI');
            $mail->addAddress($email);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "tu token es el siguiente:  ($token) Haz clic en el siguiente enlace para restablecer tu contraseña: 
            http://localhost/isamaking/HTMLS/recuperar_contrase%C3%B1a.html";

            $mail->send();
            echo "email enviado. Revisa tu bandeja de entrada.";
        } catch (Exception $e) {
            echo "No se pudo enviar el email. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "email no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>