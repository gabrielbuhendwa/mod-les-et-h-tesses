<?php
require('../database/db.php');

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

// Query to find the user with the given token
$user_token = $bdd->prepare('SELECT * FROM users WHERE account_activation_hash = ?');
$user_token->execute(array($token_hash));

// Fetch user data
$user = $user_token->fetch();

if ($user) {
    // Update the account_activation_hash to NULL to activate the account
    $account_activate = $bdd->prepare('UPDATE users SET account_activation_hash = NULL WHERE id = ?');
    $account_activate->execute(array($user["id"]));

    $_SESSION['status'] = "Votre compte a été activé; Veuillez vous connectez maintenant.";
    echo '<script>
            setTimeout(function() {
                window.location.href = "../pages/login.php";
            }, 9000);
        </script>';
} else {
    $error = "Token not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account activated</title>
</head>
<body>
    
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var messageText = "<?= $_SESSION['status'] ?? ''; ?>";
            if (messageText != '') {
                Swal.fire({
                    title: "Parfait !",
                    text: messageText,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../pages/login.php";
                    }
                });

                <?php unset($_SESSION['status']); ?>
            }
        });
    </script>
</html>

