<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/head_footer.css"/>
</head>
<header>
    <div class="nav-bar">
        <div class="logo">
            <span><img src="../asset/images/GENERAL_CONS_LOGO.pdf_2_-removebg-preview.png" alt="Landscape 1" class="img1"></span>
        </div>
        <nav>
            <ul>
                <li><a href="../index.php">Acceuil</a></li>
                <li><a href="../pages/about_us.php">À Propos</a></li>
                <li><a href="../pages/services.php">Services</a></li>
                <li><a href="../pages/gallerie.php">Galerie</a></li>
                
                <li class="dropdown">
                  <a href="#">S'inscrire</a>
                  <ul class="dropdown-menu">
                      <li><a href="../pages/modèle.php">Modèle</a></li>
                      <li><a href="../pages/hôtesses.php">Hôtesse</a></li>
                  </ul>
                </li>
                <li><a href="../pages/contact_us.php">Contact</a></li>
                <!-- Language Selector -->
                <!--------<li class="language-selector">
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
                </li>----------->           
            </ul>
        </nav>
        <!-- Profile Circle -->
        <div class="profile-circle">
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
                <img src="../asset/images/profiles/<?= htmlspecialchars($_SESSION['profile_picture']) ?>" alt="Profile">
                <ul class="profile-dropdown">
                    <li><a href="../pages/profile.php">Mon Compte</a></li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a href="../admin/dashboard.php">Espace Admin</a></li> <!-- Admin dashboard link -->
                    <?php endif; ?>
                    <li><a href="../controllers/logout.php">Se Déconnecter</a></li>
                </ul>
            <?php else: ?>
                <i class="fa-solid fa-user"></i>
                <ul class="profile-dropdown">
                    <li><a href="../pages/login.php">Se Connecter</a></li>
                    <li><a href="../pages/signup.php">Créer un compte</a></li>
                </ul>
            <?php endif; ?>
        </div>
        <div class="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu">
    <nav>
        <ul>
            <li><a href="../index.php">Acceuil</a></li>
            <li><a href="../pages/about_us.php">À Propos</a></li>
            <li><a href="../pages/services.php">Services</a></li>
            <li><a href="../pages/gallerie.php">Galerie</a></li>
            <li><a href="../pages/contact_us.php">Contact</a></li>
            <!-- Language Selector -->
            <!-----------<li class="language-selector">
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
            </li>-------------->            
            <li class="dropdown">
                <a href="#">S'inscrire</a>
                <ul class="dropdown-menu">
                    <li><a href="../pages/modèle.php">Modèle</a></li>
                    <li><a href="../pages/hôtesses.php">Hôtesse</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Profile Circle-menu-->
    <div class="profile-circle-menu">
        <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
            <img src="../asset/images/profiles/<?= htmlspecialchars($_SESSION['profile_picture']) ?>" alt="Profile">
            <ul class="profile-dropdown-menu">
                <li><a href="../pages/profile.php">Mon Compte</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="../admin/dashboard.php">Espace Admin</a></li> <!-- Admin dashboard link -->
                <?php endif; ?>
                <li><a href="../controllers/logout.php">Se Déconnecter</a></li>
        
            </ul>
        <?php else: ?>
            <i class="fa-solid fa-user"></i>
            <ul class="profile-dropdown-menu">
                <li><a href="../pages/login.php">Se Connecter</a></li>
                <li><a href="../pages/signup.php">Créer un compte</a></li>
            </ul>
        <?php endif; ?>
    </div>

</div>