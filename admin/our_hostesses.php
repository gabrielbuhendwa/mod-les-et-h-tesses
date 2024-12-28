<?php 
    require('../controllers/our_hostessesController.php');

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
    <title>models_requests</title>
</head>
<body>
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <?php include '../includes/sidebar.php'?>

    <div class="main-content">
    <div class="header">
        <h2>Nos Hôtesses (<?= htmlspecialchars($total_models) ?>)</h2>
        <input type="text" class="search-bar" id="live-search" placeholder="Search orders...">
    </div>
    <div class="table-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Nom complet</th>
                    <th>Ville</th>
                    <th>Nationalité</th>
                    <th>Taille</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="search-results">
                <?php foreach ($models as $request): ?>
                    <tr>
                        <td>
                            <div class="customer-info">
                            <img src="../asset/images/models/<?= htmlspecialchars($request['face_portrait']) ?>" alt="<?= htmlspecialchars($request['first_name']) ?>" class="profile-pic">
                                <?= htmlspecialchars($request['first_name'] . ' ' . $request['last_name']) ?>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($request['city']) ?></td>
                        <td><?= htmlspecialchars($request['nationality']) ?></td>
                        <td><?= htmlspecialchars($request['height']) ?></td>
                        <td><?= htmlspecialchars(date("F j, Y", strtotime($request['approval_date']))) ?></td>
                        <td>
                            <a href="hostesses_details.php?id=<?= htmlspecialchars($request['id']) ?>" class="action-btn view-details">Voir en détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
    <!---------live search js-------------->
    <script>
         document.getElementById('live-search').addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#search-results tr');

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            if (rowText.includes(query)) {
                row.style.display = ''; // Show row
            } else {
                row.style.display = 'none'; // Hide row
            }
            });
        });
    </script>
    
</body>
</html>