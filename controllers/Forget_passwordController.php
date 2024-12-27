<?php
    require('../database/db.php');
    if(isset($_POST['reset'])){

        if(!empty($_POST['email'])){
            $email_user = htmlspecialchars($_POST['email']);

            $CheckUser = $bdd->prepare('SELECT * FROM users WHERE email =?');
            $CheckUser->execute(array($email_user));

            if($CheckUser->rowCount() > 0){
                $token = bin2hex(random_bytes(16));
                $token_hash = hash("sha256", $token);
                $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

                $amdin_token = $bdd->prepare('UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?');
                $amdin_token->execute(array($token_hash, $expiry, $email_user));

                $mail= require('mailer.php');

                $mail->setFrom("generalconsultinggroupltd@gmail.com");
                $mail->addAddress($email_user);
                $mail->CharSet = 'UTF-8'; // Définit l'encodage des caractères à UTF-8
                $mail->Subject = "Réinitialisation du mot de passe";
                $mail->Body = <<<END

                <p>Bonjour,</p>

                <p>Nous avons reçu une demande de réinitialisation de votre mot de passe pour votre compte sur <strong>Models & Hostesses by General Consulting Group</strong>. Si vous êtes à l'origine de cette demande, veuillez cliquer sur le lien ci-dessous pour définir un nouveau mot de passe :</p>

                <p><a href="https://www.modelshostesses.com/controllers/reset_password.php?token=$token">Cliquez ici pour réinitialiser votre mot de passe</a></p>

                <p>Si vous n'avez pas demandé de réinitialisation, veuillez ignorer cet email. Votre mot de passe actuel reste sécurisé.</p>

                <p>Nous restons à votre disposition pour toute assistance supplémentaire.</p>

                <p>Cordialement,</p>
                <p>L'équipe de <strong>Models & Hostesses by General Consulting Group</strong></p>


                END;

                try {

                    $mail->send();
            
                } catch (Exception $e) {
            
                    $error= "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
            
                }
                $_SESSION['status'] = "Email envoyé. Veuillez vérifier votre boîte mail.";
                echo '<script>
                                        setTimeout(function() {
                                            window.location.href = "../pages/forget_password.php";
                                        }, 10000);
                                    </script>';
                
            }else{
                $error= "Email non trouvé, Nous ne pouvons pas proceder votre requette";
            }

        }
        else{
            $error = "Veuillez entrez Votre Adresse Email";
        }
    }
?>


