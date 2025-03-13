<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y sanitizar los datos del formulario
    $nombre  = strip_tags(trim($_POST["nombre"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["mensaje"]);

    // Validar campos
    if ( empty($nombre) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        echo "Por favor, completa el formulario correctamente.";
        exit;
    }

    // Configurar destinatario y asunto
    $destinatario = "manucg00@hotmail.com";
    $asunto       = "Nuevo mensaje de $nombre";

    // Construir el contenido del correo
    $contenido  = "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    // Encabezados del correo
    $headers = "From: $nombre <$email>";

    // Enviar el correo
    if (mail($destinatario, $asunto, $contenido, $headers)) {
        echo "¡Gracias! Tu mensaje ha sido enviado.";
    } else {
        echo "Lo siento, ocurrió un error al enviar el mensaje.";
    }
} else {
    echo "Método de envío no válido.";
}
?>
