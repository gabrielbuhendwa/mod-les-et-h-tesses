<?php 
    require('../controllers/loginController.php');
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
                <h2>Connexion</h2>
                <?php if(isset($error)) { ?>
                <div style="text-align: center; color: red;">
                        <?php echo $error; ?>
                </div>
                    <?php } ?>
                <form id="loginForm" action="#" method="POST">
                    <input type="email" id="email" name="email" placeholder="Email"/>
                    <input type="password" id="password" name="password" placeholder="Mot de passe"/>
                   
                    <button type="submit" name="send" class="send-btn">Se connecter</button>
                </form>
                <p><a href="forget_password.php" class="link">Mot de passe oublié ?</a></p>
                <p>Nouveau ici ? <a href="signup.php" class="link">Créer un compte</a></p>
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
                        window.location.href = "../index.php";
                    }
                });

                <?php unset($_SESSION['status']); ?>
            }
        });
    </script>
</html>
