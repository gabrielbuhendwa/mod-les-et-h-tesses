<?php
require('mailer.php'); // Include your PHPMailer setup
session_start();

// Sanitize input
function clean_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {

        $name = clean_input($_POST['name']);
        $email = clean_input($_POST['email']);
        $subject = clean_input($_POST['subject']);
        $message = clean_input($_POST['message']);

        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                // Email configuration
                $mail->setFrom("generalconsultinggroupltd@gmail.com", "Contact Form"); // Admin email as sender
                $mail->addReplyTo($email, $name); // Visitor email as reply-to
                $mail->addAddress("generalconsultinggroupltd@gmail.com"); // Admin email
                $mail->Subject = $subject;

                // Email body
                $mail->Body = "
                    <html>
                    <body style='font-family: Arial, sans-serif; padding: 20px; color: #333;'>
                        <h2 style='color: #2C3E50;'>Nouveau message via le formulaire de contact - Models & Hostesses</h2>
                        <p><strong>Nom :</strong> {$name}</p>
                        <p><strong>Email :</strong> {$email}</p>
                        <p><strong>Sujet :</strong> {$subject}</p>
                        <p><strong>Message :</strong></p>
                        <div style='padding: 10px; background-color: #F4F6F6; border-radius: 5px;'>
                            <p>{$message}</p>
                        </div>
                    </body>
                    </html>
                ";
                $mail->isHTML(true);

                // Attempt to send email
                if ($mail->send()) {
                    $_SESSION['status'] = "Nous avons bien reçu votre message. Nous vous répondrons sous peu.";
                    echo '<script>
                            setTimeout(function() {
                                window.location.href = "../index.php";
                            }, 9000);
                          </script>';
                } else {
                    $error = "Échec de l'envoi du message. Veuillez réessayer.";
                }
            } catch (Exception $e) {
                $error = "Erreur d'envoi : {$mail->ErrorInfo}";
            }
        } else {
            $error = "Le format de l'email est invalide.";
        }
    } else {
        $error = "Tous les champs sont requis.";
    }
}

?>
