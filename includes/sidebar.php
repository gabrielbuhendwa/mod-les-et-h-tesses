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
        $_SESSION['role'] = $user['role'];  // Add the role to session
    }
}
?>
<div class="sidebar">
        <div class="logo">
            <span><img src="../asset/images/GENERAL_CONS_LOGO.pdf_2_-removebg-preview.png" alt="Landscape 1" class="img1"></span>
        </div>
        <div class="sidebar-brand"></div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="models_requests.php">Requêtes Modèles</a></li>
            <li><a href="hostesses_requests.php">Requêtes Hôtesses</a></li>
            <li><a href="our_models.php">Nos Modèles</a></li>
            <li><a href="our_hostesses.php">Nos Hôtesses</a></li>
            <li><a href="our_partners.php">Nos partenaires</a></li>
        </ul>
        <!-- Profile and Logout Section -->
        <div class="sidebar-profile">
            <a href="../pages/profile.php" class="profile-link">
                <div class="profile-pic">
                    <img src="../asset/images/profiles/<?= htmlspecialchars($_SESSION['profile_picture']) ?>" alt="Profile">
                </div>
                <div class="profile-details">
                    <div class="profile-name"><?= htmlspecialchars($_SESSION['first_name']) ?> <?= htmlspecialchars($_SESSION['last_name']) ?></div>
                </div>
            </a>
            <a href="../controllers/logout.php" class="logout-btn">Logout</a>
        </div>
</div>