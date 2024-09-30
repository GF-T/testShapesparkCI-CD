<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);

    // Verifica que los campos no estén vacíos
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor completa el formulario correctamente.";
        exit;
    }

    // Configuración del correo
    $recipient = "test@greenfieldteam.net"; 
    $subject = "Nuevo mensaje de $name";
    $email_content = "Nombre: $name\n";
    $email_content .= "Correo: $email\n\n";
    $email_content .= "Teléfono:\n$phone\n";
    $email_headers = "From: $name <$email>";

    // Envío del correo
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Correo enviado correctamente.";
    } else {
        http_response_code(500);
        echo "Hubo un problema al enviar el correo.";
    }
} else {
    http_response_code(403);
    echo "Hubo un problema con tu solicitud.";
}
?>