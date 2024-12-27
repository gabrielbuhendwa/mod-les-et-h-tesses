<?php
session_start();
require('../database/db.php');

if (isset($_POST['send'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        // Sanitize user input
        $user_email = htmlspecialchars($_POST['email']);
        $user_password = htmlspecialchars($_POST['password']);

        // Check if the user exists
        $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $checkIfUserExists->execute(array($user_email));

        if ($checkIfUserExists->rowCount() > 0) {
            // Fetch user details
            $usersInfos = $checkIfUserExists->fetch();

            // Check if the account is activated
            if ($usersInfos['account_activation_hash'] === NULL) {
                // Verify the password
                if (password_verify($user_password, $usersInfos['password'])) {
                    // Initialize session variables
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $usersInfos['id'];
                    $_SESSION['first_name'] = $usersInfos['first_name'];
                    $_SESSION['last_name'] = $usersInfos['last_name'];
                    $_SESSION['email'] = $usersInfos['email'];
                    $_SESSION['profile_picture'] = !empty($usersInfos['profile_picture']) 
                        ? $usersInfos['profile_picture'] 
                        : 'images.png'; // Default profile picture if none provided

                    $_SESSION['status'] = "vous êtes maintenant connecté";
                    echo '<script>
                            setTimeout(function() {
                                window.location.href = "../index.php";
                            }, 3000);
                        </script>';
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            } else {
                $error = "Votre compte doit être activé avant de pouvoir vous connecter.";
            }
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } else {
        $error = "Tous les champs sont requis.";
    }
}
?>
