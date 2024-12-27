<?php 
    require('../database/db.php');
    require('../controllers/contact_usController.php');

    if (isset($_SESSION['id'])) {
      $query = $bdd->prepare("SELECT * FROM users WHERE id = ?");
      $query->execute([$_SESSION['id']]);
      $user = $query->fetch();
  
      if ($user) {
          $_SESSION['profile_picture'] = $user['profile_picture'];
          $_SESSION['first_name'] = $user['first_name'];
          $_SESSION['last_name'] = $user['last_name'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['role'] = $user['role'];
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/contact_us.css"/>
    <title>Contact_us</title>
</head>
<body>
<?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="contact-section">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2>Nos coordonnées</h2>
                    <p><strong>Address:</strong> KN 4 Av 22, KIGALI - RWANDA</p>
                    <p><strong>Téléphone:</strong> +250 736 536 458</p>
                    <p><strong>Email:</strong> contact@generalconsultinggroups.com</p>
                    <p><strong>WhatsApp:</strong> +250 796 129 284</p>
                </div>
                <div class="contact-form">
                <h2>Contactez Nous</h2>
                    <?php if (isset($error)) { ?>
                        <div style="text-align: center; color: red;">
                            <?= htmlspecialchars($error); ?>
                        </div>
                    <?php } ?>
                    <form action="#" method="POST">
                        <input type="text" name="name" placeholder="Nom" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        <input type="email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <input type="text" name="subject" placeholder="Sujet" value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                        <textarea name="message" rows="5" placeholder="Votre Message"><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                        <button type="submit" class="send-btn">Envoyer</button>
                    </form>
                </div>
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