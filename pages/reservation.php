<?php 
    require('../controllers/reservationController.php');

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
    <link rel="stylesheet" href="../asset/css/reservation.css" />
    <title>Reservation</title>
</head>
<body>
<?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="gallery">
            <div class="image-card">
                <img src="../asset/images/models/<?php echo htmlspecialchars($details['face_portrait']); ?>" alt="Face Portrait">
            </div>
            <div class="image-card">
                <img src="../asset/images/models/<?php echo htmlspecialchars($details['profile_portrait']); ?>" alt="Profile Portrait">
            </div>
            <div class="image-card">
                <img src="../asset/images/models/<?php echo htmlspecialchars($details['full_body_front_side']); ?>" alt="Full Body Front Side">
            </div>
            <div class="image-card">
                <img src="../asset/images/models/<?php echo htmlspecialchars($details['action_shot']); ?>" alt="Action Shot">
            </div>
            <div class="image-card">
                <img src="../asset/images/models/<?php echo htmlspecialchars($details['swimwear_photo']); ?>" alt="Swimwear Photo">
            </div>
        </div>
        <div class="reservation-button">
            <button onclick="document.getElementById('reservationModal').style.display='flex'">Réserver celle-ci</button>
        </div>
    </section>
    <!-- Reservation Modal -->
    <div id="reservationModal" class="modal" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h3>Veuillez prendre connaissance de notre politique d'annulation et de modification avant toute réservation. Cette lecture est essentielle pour garantir une expérience sereine.</h3>
            <div class="modal-buttons">
                <button class="modal-button lire" onclick="window.location.href='reservation_policy.php'">Lire</button>
                <!-- Dynamic Reservation Button -->
                <?php if ($type === 'MODÈLES'): ?>
                <button class="modal-button reserver" onclick="window.location.href='reservation_form.php?id=<?php echo $details['id']; ?>&type=models'">Réserver</button>
            <?php elseif ($type === 'HÔTESSES'): ?>
                <button class="modal-button reserver" onclick="window.location.href='reservation_form.php?id=<?php echo $details['id']; ?>&type=hostesses'">Réserver</button>
            <?php endif; ?>

            </div>
        </div>
    </div>
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
 <!-----------------modal_close_behavior---------------->
 <script>
    function closeModal(event) {
        if (event.target.id === 'reservationModal') {
            document.getElementById('reservationModal').style.display = 'none';
        }
    }
 </script>
</html>
