<?php
    session_start();
    require('../database/db.php');


    $token = $_POST["token"];
    $token_hash = hash("sha256", $token);

    $user_token = $bdd->prepare('SELECT * FROM users WHERE reset_token_hash = ?');
    $user_token->execute(array($token_hash));

    $user = $user_token->fetch();
    if ($user_token->rowCount() > 0) {
        if (strtotime($user["reset_token_expires_at"]) < time()) {
            $error = "Le token a expiré.";
        }
        if(isset($_POST['new'])){
            if(!empty($_POST['new_password']) AND !empty($_POST['confirm_password'])){
    
            }
            else{
                $error= "Tous les champs sont requis";
            }
        }
    }
    else{
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
</html>
