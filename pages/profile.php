<?php 
    require('../controllers/profileController.php');

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/profile.css"/>
    <title>Mon compte</title>
</head>
<body>
<?php include '../includes/head.php'; ?>
<section class="profile-section">
<div class="profile-wrapper">
    <!-- Left Side: User Information -->
    <div class="user-info">
        <h2>Informations du Profil</h2>
        <div class="profile-picture">
            <img src="../asset/images/profiles/<?= $user['profile_picture'] ?: 'default.jpg'; ?>" alt="Profile Picture">
        </div>
        <p><strong>Prénom:</strong> <?= htmlspecialchars($user['first_name']); ?></p>
        <p><strong>Nom:</strong> <?= htmlspecialchars($user['last_name']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <p><strong>Téléphone:</strong> <?= htmlspecialchars($user['telephone']); ?></p>
        <p><strong>Adresse:</strong> <?= htmlspecialchars($user['address']); ?></p>
    </div>

    <!-- Right Side: User Edit Form -->
    <div class="user-edit-form">
        <h2>Modifier le Profil</h2>
        <?php if(isset($error)) { ?>
                <div style="text-align: center; color: red;">
                        <?php echo $error; ?>
                </div>
                    <?php } ?>
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="first_name" placeholder="Prénom" value="<?= htmlspecialchars($user['first_name']); ?>" required>
            <input type="text" name="last_name" placeholder="Nom" value="<?= htmlspecialchars($user['last_name']); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email']); ?>" required>
            <input type="text" name="phone" placeholder="Téléphone" value="<?= htmlspecialchars($user['telephone']); ?>" required>
            <input type="text" name="address" placeholder="Adresse" value="<?= htmlspecialchars($user['address']); ?>" required>
            <input type="file" name="profile" accept="image/*">
            <input type="password" name="new_password" placeholder="Nouveau mot de passe"> 
            <label for="current_password" style="color: #d9534f; font-weight: bold; margin-bottom: -15px;">Mot de passe actuel (Obligatoire)</label>
            <input type="password" name="current_password" placeholder="Entrez votre mot de passe actuel" style="border: 2px solid #d9534f; padding: 12px;">
            <button type="submit" class="edit-btn">Modifier</button>
        </form>
    </div>
</div>

</section>
<?php include '../includes/footer.php'; ?>

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
                    title: "Done !!",
                    text: messageText,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "profile.php";
                    }
                });

                <?php unset($_SESSION['status']); ?>
            }
        });
    </script>
</html>