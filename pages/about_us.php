<?php 
    session_start(); 
    require('../database/db.php');

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
    <title>À Propos de nous</title>
    <link rel="stylesheet" href="../asset/css/about_us.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="content-wrapper">
            <div class="about-content">
                <h1 class="about-title">À Propos de Nous</h1>
                    <div class="text-content">
                        <p>Chez Models & Hostesses by General Consulting Group, nous sommes plus qu’une simple agence de mannequins et d'hôtesses – nous sommes le reflet de l'élégance, de l'authenticité, et du professionnalisme au cœur des industries de la mode, de l'événementiel, et de l'hospitalité.</p>
                        <p>Fondée sous la bannière de General Consulting Group, notre branche spécialisée dans le mannequinat et les services d'hôtesses est une réponse directe aux besoins exigeants et raffinés des entreprises modernes qui recherchent une touche unique et personnalisée pour leurs événements, leurs campagnes de marque, ou leurs activités promotionnelles.</p>
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
</html>