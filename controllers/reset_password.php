<?php
session_start();
require('../database/db.php');

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$user_token = $bdd->prepare('SELECT * FROM users WHERE reset_token_hash = ?');
$user_token->execute(array($token_hash));

$user = $user_token->fetch();
if ($user_token->rowCount() > 0) {
    if (strtotime($user["reset_token_expires_at"]) < time()) {
        $error = "Le token a expiré.";
    }
    if (isset($_POST['new'])) {
        $token = $_POST["token"];
        if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate password strength
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

            $password_validation_result = validatePassword($new_password);
            if ($password_validation_result === true) {
                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_password = $bdd->prepare('UPDATE users SET password = ? WHERE reset_token_hash = ?');
                    $update_password->execute(array($hashed_password, $token_hash));
                    $_SESSION['status'] = "Mot de passe changé avec succès. Connectez-vous à nouveau avec vos nouveaux identifiants.";
                    echo '<script>
                            setTimeout(function() {
                                window.location.href = "../pages/login.php";
                            }, 10000);
                          </script>';
                } else {
                    $error = "Les mots de passe ne correspondaient pas.";
                }
            } else {
                $error = $password_validation_result; // Display password strength error
            }
        } else {
            $error = "Tous les champs sont requis.";
        }
    }
} else {
    $error = "Le token n'a pas été trouvé.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Connexion</title>
    <link rel="stylesheet" href="../asset/css/connexions.css">
</head>
<body>
    <?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="contact-section">
            <div class="contact-form">
                <h2>Changer le mot de passe</h2>
                <?php if (isset($error)) { echo '<font color="red">'.$error."</font>"; } ?>
                <form id="loginForm" action="#" method="POST">
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                    <input type="password" id="password" name="new_password" placeholder="Nouveau mot de passe (Ex: Pass1234!)"/>
                    <input type="password" id="password" name="confirm_password" placeholder="Confirmez-le"/>
                   
                    <button type="submit" name="new" class="send-btn">Mofifier</button>
                </form>
            </div>
        </div>
    </section>      
    <?php include '../includes/footer.php'?>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const menuToggle = document.querySelector('.menu-toggle');
      const mobileMenu = document.querySelector('.mobile-menu');
      const toggleIcon = menuToggle.querySelector('i');

      menuToggle.addEventListener('click', () => {
          // Toggle the mobile menu visibility
          mobileMenu.classList.toggle('open');
          
          // Change the icon between the hamburger and close (X) icon
          toggleIcon.classList.toggle('fa-bars');
          toggleIcon.classList.toggle('fa-xmark');
      });
  });
 </script>
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
