<?php 
    require('../controllers/partnersController.php');

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
    <title>Add Partner</title>
</head>
<body>
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <?php include '../includes/sidebar.php'?>

    <div class="main-content">
    <section class="form-section">
        <h2 class="form-title">Ajouter un Partenaire</h2>
        <?php if (isset($error)) { ?>
            <div style="text-align: center; color: red;">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form action="" method="POST" enctype="multipart/form-data" class="partner-form">
            <div class="form-group">
                <label for="photo">Photo du Partenaire</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="name">Nom du Partenaire</label>
                <input type="text" id="name" name="name" placeholder="Nom du partenaire" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Décrivez le partenaire..." value="<?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?>"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="add" class="submit-button">Ajouter</button>
            </div>
        </form>
    </section>
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
