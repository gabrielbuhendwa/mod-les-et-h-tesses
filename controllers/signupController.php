<?php
session_start();
require('../database/db.php');

if (isset($_POST['send'])) {
    // Check if all required fields are filled
    if (
        !empty($_POST['first_name']) && 
        !empty($_POST['last_name']) && 
        !empty($_POST['email']) && 
        !empty($_POST['phone']) && 
        !empty($_POST['address']) && 
        !empty($_POST['password']) && 
        !empty($_POST['confirm_password'])
    ) {
        // Sanitize and validate user input
        $first_name = htmlspecialchars(trim($_POST['first_name']));
        $last_name = htmlspecialchars(trim($_POST['last_name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone']));
        $address = htmlspecialchars(trim($_POST['address']));
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        


        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Veuillez entrer un email valide.";
        } else {
            // Check if email exists (using an API or custom function)
            if (!checkEmailExists($email)) {
                $error = "L'email n'existe pas.";
            } else {
                // Check password strength
                $password_error = validatePassword($password);
                if ($password_error !== true) {
                    $error = $password_error; // Set the specific password error
                } else {
                    // Check if the passwords match
                    if ($password === $confirm_password) {
                        // Hash the password securely
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Check if the email already exists in the database
                        $query = $bdd->prepare('SELECT email FROM users WHERE email = ?');
                        $query->execute([$email]);

                        if ($query->rowCount() === 0) {
                            if (preg_match('/^\+[1-9][0-9]{1,3}[0-9]{6,12}$/', $phone)) {

                                $activation_token = bin2hex(random_bytes(16));
                                $activation_token_hash = hash("sha256", $activation_token);
                                //insert user in the database as well 
                                $insertUser = $bdd->prepare('INSERT INTO users (first_name, last_name, email, telephone, address, password, account_activation_hash) VALUES (?, ?, ?, ?, ?, ?, ?)');
                                $insertUser->execute(array($first_name, $last_name, $email, $phone, $address, $hashed_password, $activation_token_hash));
                                
                                
                                //sending the message confirmation in the user inbox as well
                                $mail= require('mailer.php');

                                $mail->setFrom("generalconsultinggroupltd@gmail.com");
                                $mail->addAddress($_POST["email"]);
                                $mail->Subject = "Confirmation de l'activation de votre compte";
                                $mail->Body = <<<END

                                <p>Bonjour,</p>

                                <p>Nous vous remercions de vous être inscrit(e) sur <strong>Models & Hostesses by General Consulting Group</strong>. Pour finaliser votre inscription et activer votre compte, veuillez cliquer sur le lien ci-dessous :</p>

                                <p><a href="https://www.modelshostesses.com/controllers/activate_account.php?token=$activation_token">Cliquez ici pour activer votre compte</a></p>

                                <p>Si vous n'avez pas demandé cette inscription, veuillez ignorer cet email.</p>

                                <p>Nous vous remercions pour votre confiance et restons à votre disposition pour toute information complémentaire.</p>

                                <p>Cordialement,</p>
                                <p>L'équipe de <strong>Models & Hostesses by General Consulting Group</strong></p>


                                END;

                                try {

                                    $mail->send();
                            
                                } catch (Exception $e) {
                            
                                    $error= "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                                    exit;
                            
                                }
                                $_SESSION['status'] = "Votre compte a été créé avec succès ! Vérifiez votre boîte mail pour l'activer.";
                                echo '<script>
                                        setTimeout(function() {
                                            window.location.href = "../pages/signup.php";
                                        }, 9000);
                                    </script>';
                            

                                
                            } else {
                                $error = "Le numéro de téléphone doit commencer par un indicatif de pays (ex. +33) et contenir 8 à 15 chiffres après.";
                            }
                            
                           
                        } else {
                            $error = "Cet email est déjà associé à un compte.";
                        }
                    } else {
                        $error = "Les mots de passe ne correspondaient pas.";
                    }
                }
            }
        }
    } else {
        $error = "Tous les champs sont requis.";
    }
}

// Function to validate password strength
function validatePassword($password) {
    if (strlen($password) < 8 || strlen($password) > 15) {
        return "Le mot de passe doit contenir entre 8 et 15 caractères.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Le mot de passe doit contenir au moins une lettre majuscule.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Le mot de passe doit contenir au moins une lettre minuscule.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Le mot de passe doit contenir au moins un chiffre.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        return "Le mot de passe doit contenir au moins un caractère spécial.";
    }
    return true; // Password is strong
}

// Function to check if email exists (using an external API or custom logic)
function checkEmailExists($email) {
    // Example: Using the "verify-email.org" API (or any other reliable service)
    // For demo purposes, we'll return true.
    // Replace this with actual email verification logic.
    return true; // Assume the email exists
}
?>
