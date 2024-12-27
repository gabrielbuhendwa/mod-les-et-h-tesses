<?php 
    session_start(); 
    require('../controllers/galleryController.php');

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
    <link rel="stylesheet" href="../asset/css/gallerie.css">
    <title>Galerie</title>
</head>
<body>
<?php include '../includes/head.php'?>
    <section class="hero-section">
        <h2 class="gallery-title">Bienvenue à notre Galerie</h2>
            <div class="gallery">
            <?php
            // Display models
            foreach ($models as $model) {
                echo '
                <div class="card">
                    <img src="../asset/images/models/' . htmlspecialchars($model['full_body_front_side']) . '" alt="' . htmlspecialchars($model['first_name']) . ' ' . htmlspecialchars($model['last_name']) . '">
                    <h3>' . strtoupper(htmlspecialchars($model['code_number'])) . '</h3>
                    <div class="card-details">
                        <p><strong>MODÈLES</strong></p>
                        <p><strong>Sexe:</strong> ' . htmlspecialchars($model['gender']) . '</p>
                        <p><strong>Ville:</strong> ' . htmlspecialchars($model['city']) . '</p>
                        <p><strong>Nom de Code:</strong> ' . strtoupper(htmlspecialchars($model['code_number'])) . '</p>
                        <p><strong>Nationalité:</strong> ' . htmlspecialchars($model['nationality']) . '</p>
                        <p><strong>Taille:</strong> ' . htmlspecialchars($model['height']) . ' cm</p>
                        <p><strong>Cheveux:</strong> ' . htmlspecialchars($model['hair']) . '</p>
                        <p><strong>Yeux:</strong> ' . htmlspecialchars($model['eye']) . '</p>
                        <p><strong>Pointure:</strong> ' . htmlspecialchars($model['shoes_size']) . '</p>
                    </div>
                </div>';
            }

            // Display hostesses
            foreach ($hostesses as $hostess) {
                echo '
                <div class="card">
                    <img src="../asset/images/models/' . htmlspecialchars($hostess['full_body_front_side']) . '" alt="' . htmlspecialchars($hostess['first_name']) . ' ' . htmlspecialchars($hostess['last_name']) . '">
                    <h3>' . strtoupper(htmlspecialchars($hostess['code_number'])) . '</h3>
                    <div class="card-details">
                        <p><strong>HÔTESSES</strong></p>
                        <p><strong>Sexe:</strong> ' . htmlspecialchars($hostess['gender']) . '</p>
                        <p><strong>Ville:</strong> ' . htmlspecialchars($hostess['city']) . '</p>
                        <p><strong>Nom de Code:</strong> ' . strtoupper(htmlspecialchars($hostess['code_number'])) . '</p>
                        <p><strong>Nationalité:</strong> ' . htmlspecialchars($hostess['nationality']) . '</p>
                        <p><strong>Taille:</strong> ' . htmlspecialchars($hostess['height']) . ' cm</p>
                        <p><strong>Cheveux:</strong> ' . htmlspecialchars($hostess['hair']) . '</p>
                        <p><strong>Yeux:</strong> ' . htmlspecialchars($hostess['eye']) . '</p>
                        <p><strong>Pointure:</strong> ' . htmlspecialchars($hostess['shoes_size']) . '</p>
                    </div>
                </div>';
            }
            ?>
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