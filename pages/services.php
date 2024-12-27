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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/services.css"/>
    <title>Nos Services</title>
</head>
<body>
  <?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="services-header">
          <h1>Nos Services</h1>
          <h2>Nous proposons une gamme de services de premier ordre, adaptés aux besoins spécifiques de chaque client</h2>
        </div>
        <div class="services-grid">
          <div class="service-card service-mannequins">
            <div class="icon-wrapper">
              <i class="fa-solid fa-user-tie"></i>
            </div>
            <h3>Mannequins Professionnels</h3>
            <p>Nous mettons à disposition des mannequins soigneusement sélectionnés pour répondre aux besoins des campagnes publicitaires, des défilés de mode, des shootings éditoriaux, et bien plus encore. Nos mannequins allient charisme, présence scénique et professionnalisme, offrant ainsi une représentation visuelle impeccable pour chaque marque.</p>
          </div>
          <div class="service-card service-hotesses">
            <div class="icon-wrapper">
              <i class="fa-solid fa-handshake-angle"></i>
            </div>
            <h3>Hôtesses & Modèles </h3>
            <p>Nos hôtesses et Modèles  sont formés pour offrir un service d'accueil exceptionnel, alliant courtoisie, élégance et professionnalisme. Que ce soit pour des salons, des conférences, des événements privés ou d'entreprise, notre personnel d'accueil est à l’image de l’excellence que nous défendons.</p>
          </div>
          <div class="service-card service-promotion">
            <div class="icon-wrapper">
              <i class="fa-solid fa-bullseye"></i>
            </div>
            <h3>Services de Promotion & Street Marketing</h3>
            <p> Pour les campagnes promotionnelles qui requièrent une approche directe et impactante, nous fournissons des équipes dynamiques et expérimentées capables de représenter votre marque dans des actions de terrain avec un engagement qui marque les esprits.</p>
          </div>
          <div class="service-card service-evenements">
            <div class="icon-wrapper">
              <i class="fa-solid fa-calendar-check"></i>
            </div>
            <h3>Coordination d’Événements</h3>
            <p>Avec une solide expertise en gestion événementielle, nous prenons en charge la planification et l’organisation de vos événements, garantissant une exécution sans faille. Notre équipe assure un service clé en main, de la conception à la mise en œuvre, pour un événement mémorable.</p>
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