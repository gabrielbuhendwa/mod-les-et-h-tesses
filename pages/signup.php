<?php 
    require('../controllers/signupController.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="../asset/css/connexions.css">
</head>

<body>
    <?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="contact-section">
            <div class="contact-form">
                <h2>Créer un compte</h2>
                <?php if(isset($error)) { ?>
                <div style="text-align: center; color: red;">
                        <?php echo $error; ?>
                </div>
                    <?php } ?>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="text" name="first_name" placeholder="Votre Nom" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>"/>
                        <input type="text" name="last_name" placeholder="Votre Prénom" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>"/>
                        <input type="email" name="email" placeholder="Votre Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"/>
                        <input type="text" name="phone" placeholder="Votre Numéro de téléphone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"/>
                        <input type="text" name="address" placeholder="Votre Address" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>"/>
                        <input type="password" name="password" placeholder="Créez votre mot de passe (Ex: Pass1234!)">
                        <input type="password" name="confirm_password" placeholder="Confirmez ce mot de passe">
                        <button type="submit" name="send" class="send-btn">S'inscrire</button>
                    </form>

                <p>Déjà inscrit ? <a href="login.php" class="link">Se connecter</a></p>
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
                        window.location.href = "signup.php";
                    }
                });

                <?php unset($_SESSION['status']); ?>
            }
        });
    </script>
</html>
