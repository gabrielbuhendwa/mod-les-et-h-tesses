<?php
    //admin security
    session_start();

    // Check if user is authenticated
    if (!isset($_SESSION['id'])) {
        header('Location: ../pages/login.php');
        exit;
    }

    // Check if user is an admin
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        // Redirect to an error page or deny access
        header('Location: ../index.php'); 
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/dasboard.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <button class="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </button>

    <?php include '../includes/sidebar.php'?>
    
    <div class="main-content">
    <div class="header">
        <h2>Dashboard Admin</h2>
    </div>
    
    <div class="stats-grid">
        <?php
        require('../database/db.php'); // Include the database connection

        try {
            // Count entries in each table
            $modelsCount = $bdd->query('SELECT COUNT(*) FROM models')->fetchColumn();
            $hostessesCount = $bdd->query('SELECT COUNT(*) FROM hostesses')->fetchColumn();
            $modelsRequestsCount = $bdd->query('SELECT COUNT(*) FROM models_request')->fetchColumn();
            $hostessesRequestsCount = $bdd->query('SELECT COUNT(*) FROM hostesses_requests')->fetchColumn();
            $partnersCount = $bdd->query('SELECT COUNT(*) FROM partners')->fetchColumn();

            // Function to determine singular/plural text
            function pluralize($count, $singular, $plural) {
                return $count <= 1 ? $singular : $plural;
            }
        ?>
            <div class="stat-card">
                <div class="stat-info">
                    <h3><?php echo $modelsCount; ?></h3>
                    <p><?php echo pluralize($modelsCount, 'Modèle', 'Modèles'); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3><?php echo $hostessesCount; ?></h3>
                    <p><?php echo pluralize($hostessesCount, 'Hôtesse', 'Hôtesses'); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3><?php echo $modelsRequestsCount; ?></h3>
                    <p><?php echo pluralize($modelsRequestsCount, 'Requête Modèle', 'Requêtes Modèles'); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3><?php echo $hostessesRequestsCount; ?></h3>
                    <p><?php echo pluralize($hostessesRequestsCount, 'Requête Hôtesse', 'Requêtes Hôtesses'); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3><?php echo $partnersCount; ?></h3>
                    <p><?php echo pluralize($partnersCount, 'Partenaire', 'Partenaires'); ?></p>
                </div>
            </div>
        <?php
        } catch (Exception $e) {
            echo "<p>Erreur lors de la récupération des données : " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</div>


    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });
    </script>
</body>
</html>