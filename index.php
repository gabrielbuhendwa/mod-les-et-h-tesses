<?php 
session_start(); 
require('database/db.php');

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
  <title>Modèles et Hôtesses</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="asset/css/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 
</head>
<body>
  <header>
    <div class="nav-bar">
        <div class="logo">
            <span><img src="asset/images/GENERAL_CONS_LOGO.pdf_2_-removebg-preview.png" alt="Landscape 1" class="img1"></span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Acceuil</a></li>
                <li><a href="pages/about_us.php">À Propos</a></li>
                <li><a href="pages/services.php">Services</a></li>
                <li><a href="pages/gallerie.php">Galerie</a></li>
                
                <li class="dropdown">
                  <a href="">S'inscrire</a>
                  <ul class="dropdown-menu">
                      <li><a href="pages/modèle.php">Modèle</a></li>
                      <li><a href="pages/hôtesses.php">Hôtesse</a></li>
                  </ul>
                </li>
                <li><a href="pages/contact_us.php">Contact</a></li>
                <!-- Language Selector -->
                <!------------<li class="language-selector">
                  <select id="languages">
                    <option value="fr">Français</option>
                    <option value="en">English</option>
                    <option value="zh-CN">中文</option>
                    <option value="es">Español</option>
                    <option value="hi">हिंदी</option>
                    <option value="ar">العربية</option>
                    <option value="pt">Português</option>
                    <option value="bn">বাংলা</option>
                    <option value="ru">Русский</option>
                    <option value="ja">日本語</option>
                    <option value="de">Deutsch</option>
                  </select>
                </li>---------------->
            </ul>
        </nav>
        <!-- Profile Circle -->
        <div class="profile-circle">
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
                <img src="asset/images/profiles/<?= htmlspecialchars($_SESSION['profile_picture']) ?>" alt="Profile">
                <ul class="profile-dropdown">
                    <li><a href="pages/profile.php">Mon Compte</a></li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a href="admin/dashboard.php">Espace Admin</a></li> <!-- Admin dashboard link -->
                    <?php endif; ?>
                    <li><a href="controllers/logout.php">Se Déconnecter</a></li>
                    
                </ul>
            <?php else: ?>
                <i class="fa-solid fa-user"></i>
                <ul class="profile-dropdown">
                    <li><a href="pages/login.php">Se Connecter</a></li>
                    <li><a href="pages/signup.php">Créer un compte</a></li>
                </ul>
            <?php endif; ?>
        </div>

        <div class="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
</header>

<!--------------------------------Mobile Menu---------------------------->
<div class="mobile-menu">
    <nav>
        <ul>
            <li><a href="index.php">Acceuil</a></li>
            <li><a href="pages/about_us.php">À Propos</a></li>
            <li><a href="pages/services.php">Services</a></li>
            <li><a href="pages/gallerie.php">Galerie</a></li>
            <li><a href="pages/contact_us.php">Contact</a></li>
            <!-- Language Selector -->
            <!----------<li class="language-selector">
              <select name="languages" id="languages-mobile">
                <option value="fr">Français</option>
                <option value="en">English</option>
                <option value="zh">中文</option>
                <option value="es">Español</option>
                <option value="hi">हिंदी</option>
                <option value="ar">العربية</option>
                <option value="pt">Português</option>
                <option value="bn">বাংলা</option>
                <option value="ru">Русский</option>
                <option value="ja">日本語</option>
                <option value="de">Deutsch</option>
              </select>
            </li>------------------->              
            <li class="dropdown">
                <a href="#">S'inscrire</a>
                <ul class="dropdown-menu">
                    <li><a href="pages/modèle.php">Modèle</a></li>
                    <li><a href="pages/hôtesses.php">Hôtesse</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Profile Circle-menu-->
    <div class="profile-circle-menu">
        <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
            <img src="asset/images/profiles/<?= htmlspecialchars($_SESSION['profile_picture']) ?>" alt="Profile">
            <ul class="profile-dropdown-menu">
                <li><a href="pages/profile.php">Mon Compte</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="admin/dashboard.php">Espace Admin</a></li> <!-- Admin dashboard link -->
                <?php endif; ?>
                <li><a href="/controllers/logout.php">Se Déconnecter</a></li>
        
            </ul>
        <?php else: ?>
            <i class="fa-solid fa-user"></i>
            <ul class="profile-dropdown-menu">
                <li><a href="pages/login.php">Se Connecter</a></li>
                <li><a href="pages/signup.php">Créer un compte</a></li>
            </ul>
        <?php endif; ?>
    </div>

  </div>

  <section class="hero-section">
      <div class="hero-content">
        <h2>Modèles et Hôtesses</h2>
            <h1>Bienvenue chez Models & Hostesses by General Consulting Group</h1>
            <p>
              Nous sommes spécialisés dans le recrutement et la gestion de talents dans le secteur du mannequinat et de l’accueil événementiel. Notre équipe s'engage à offrir des services d'excellence, mettant en avant élégance, professionnalisme et flexibilité pour répondre aux besoins uniques de chaque client. Que ce soit pour des défilés, des shootings photo, des événements d'entreprise ou des lancements de produits, notre sélection rigoureuse et notre expertise garantissent des prestations de haute qualité.
              Découvrez notre vision de l'accueil, où style et professionnalisme ne font qu'un.</p>
              <a href="pages/models_and_hostesses.php">
                <button class="order-btn">Réservez un modèle ou une hôtesse</button>
              </a>
      </div>
      <div class="image-slider">
        <img src="asset/images/img4.jpeg" alt="Landscape 1" class="img1">
        <img src="asset/images/img9.jpeg" alt="Landscape 2" class="img2">
        <img src="asset/images/img15.jpeg" alt="Landscape 3" class="img3">
      </div>
    </section>
    <section>
      <div class="inspiration">
        <h2>Pourquoi Nous Choisir ?</h2>
        <p>En collaborant avec Models & Hostesses by General Consulting Group, vous bénéficiez d’une approche personnalisée, d'une équipe attentive à vos besoins et d'une expertise de l'industrie qui garantit le succès de vos projets.</p>
        <p>Notre engagement envers la qualité et notre réseau de partenaires font de nous le choix privilégié pour les entreprises et les marques qui cherchent à se démarquer.</p>
      </div>
    </section>

    <section class="vmv-container">
      <div class="vmv-card">
        <div class="vmv-icon">
          <i class="fas fa-lightbulb"></i>
        </div>
        <h2>Notre Vision</h2>
        <p>Notre vision est de faire de Models & Hostesses by General Consulting Group un pilier de l'industrie du mannequinat et de l'accueil de luxe en Afrique, en offrant des services distinctifs et un modèle d'excellence à nos clients. En misant sur le potentiel local et la diversité culturelle, nous avons pour ambition de promouvoir l'art du mannequinat et de l'hospitalité avec un profond respect pour les talents qui composent notre équipe, tout en répondant aux standards internationaux les plus élevés.</p>
      </div>
      <div class="vmv-card">
        <div class="vmv-icon">
          <i class="fa-solid fa-hands-holding"></i>
        </div>
        <h2>Nos Valeurs</h2>
        <p>Nous croyons en la puissance de l'authenticité, de la diversité, et de l'excellence. Ces valeurs fondatrices guident notre travail au quotidien et s’inscrivent dans notre engagement envers nos clients et nos talents. Nous misons sur l’épanouissement de nos mannequins et hôtesses en leur offrant des opportunités d’évolution professionnelle et en créant un environnement respectueux et stimulant.</p>
      </div>
      <div class="vmv-card">
        <div class="vmv-icon">
          <i class="fas fa-handshake"></i>
        </div>
        <h2>Notre Engagement pour l’Avenir</h2>
        <p>Nous nous engageons à bâtir un avenir où le mannequinat et l’hospitalité seront des métiers valorisés, promus dans un cadre éthique et de respect mutuel. En tant que pionniers dans ce secteur au Cameroun et au Rwanda, nous visons à renforcer notre positionnement tout en continuant à former et à inspirer la prochaine génération de talents dans l'industrie.</p>
      </div>
    </section>

    <section class="partners">
      <h2>Nos Partenaires</h2>
      <div class="partners-container">
          <?php
          require('database/db.php'); 

          try {
            
              $query = $bdd->query('SELECT * FROM partners ORDER BY id DESC');
              $partners = $query->fetchAll(PDO::FETCH_ASSOC);

             
              if (count($partners) > 0) {
                  foreach ($partners as $partner) {
          ?>
                      <div class="partner-card">
                          <div class="partner-logo">
                              <img src="asset/images/partners/<?php echo htmlspecialchars($partner['photo']); ?>" alt="<?php echo htmlspecialchars($partner['name']); ?> Logo">
                          </div>
                          <h3><?php echo htmlspecialchars($partner['name']); ?></h3>
                          <p><?php echo htmlspecialchars($partner['description']); ?></p>
                      </div>
          <?php
                  }
              } else {
                  echo '<p>Aucun partenaire trouvé.</p>';
              }
          } catch (Exception $e) {
              echo "<p>Erreur lors de la récupération des partenaires : " . $e->getMessage() . "</p>";
          }
          ?>
      </div>
  </section>

  <footer>
    <div class="footer-about">
        <h3>Faites briller vos événements avec nos modèles et hôtesses !</h3>
        <p>Collaborons ensemble pour donner vie à vos idées dans le domaine du mannequinat et de l’hôtessariat.</p>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 GENERAL CONSULTING GROUP. Tous droits réservés.</p>
        <p>Développé par SoftCreatix</p>
        <p><a href="pages/policy.php" class="footer-link">Conditions d'utilisation et Politique de confidentialité</a></p>
    </div>
</footer>
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
</body>
</html>
