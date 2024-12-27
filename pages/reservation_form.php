<?php 
    require('../controllers/reservation_formController.php');

    if (isset($_GET['id']) && isset($_GET['type'])) {
        $id = (int)$_GET['id'];
        $type = $_GET['type'];
    
        try {
            if ($type === 'models') {
                $query = "SELECT * FROM models WHERE id = :id";
            } elseif ($type === 'hostesses') {
                $query = "SELECT * FROM hostesses WHERE id = :id";
            } else {
                die('Type invalide.');
            }
    
            $stmt = $bdd->prepare($query);
            $stmt->execute(['id' => $id]);
            $details = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$details) {
                die('Aucun modèle ou hôtesse trouvé.');
            }
    
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Reservation Form</title>
    <link rel="stylesheet" href="../asset/css/connexions.css">
</head>

<body>
    <?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="contact-section">
            <div class="contact-form">
                <h2>Réservation de modèle ou d’hôtesse</h2>
                <?php if (isset($error)) { ?>
                <div style="text-align: center; color: red;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php } elseif (isset($success)) { ?>
                <div style="text-align: center; color: green;">
                    <?php echo htmlspecialchars($success); ?>
                </div>
                <?php } ?></br>

            <form action="" method="POST">
                        <!-- Client Info -->
                        <label for="client_name">Nom du Client</label>
                        <input type="text" id="client_name" name="client_name" value="<?= htmlspecialchars($client['first_name'] . ' ' . $client['last_name']) ?>" readonly />

                        <label for="client_email">Email du Client</label>
                        <input type="email" id="client_email" name="client_email" value="<?= htmlspecialchars($client['email']) ?>" readonly />

                        <label for="client_phone">Téléphone du Client</label>
                        <input type="text" id="client_phone" name="client_phone" value="<?= htmlspecialchars($client['telephone']) ?>" readonly />

                        <!-- Model Info -->
                        <label for="model_name">
                            <?= $table === 'models' ? 'Nom du Modèle' : 'Nom de l\'Hôtesse' ?>
                        </label>
                        <input type="text" id="model_name" name="model_name" value="<?= htmlspecialchars($model['full_name'] ?? '') ?>" readonly />

                        <label for="model_email">
                            <?= $table === 'models' ? 'Email du Modèle' : 'Email de l\'Hôtesse' ?>
                        </label>
                        <input type="email" id="model_email" name="model_email" value="<?= htmlspecialchars($model['email'] ?? '') ?>" readonly />

                        <!-- Event Info -->
                        <label for="event_name">Nom de l'Événement/Projet</label>
                        <input type="text" id="event_name" name="event_name" placeholder="Nom de l'Événement/Projet" value="<?= htmlspecialchars($_POST['event_name'] ?? '') ?>"/>

                        <label for="event_start">Date de Début</label>
                        <input type="date" id="event_start" name="event_start" value="<?= htmlspecialchars($_POST['event_start'] ?? '') ?>" />

                        <label for="event_end">Date de Fin</label>
                        <input type="date" id="event_end" name="event_end" value="<?= htmlspecialchars($_POST['event_end'] ?? '') ?>" />

                        <label for="event_time">Debut des Prestations (horaires)</label>
                        <input type="time" id="event_time" name="event_time" value="<?= htmlspecialchars($_POST['event_time'] ?? '') ?>"/>

                        <label for="event_duration">Durée des Prestations (horaires)</label>
                        <select id="event_duration" name="event_duration"/>
                            <option value="" disabled <?= !isset($_POST['event_duration']) ? 'selected' : '' ?>>Choisissez la durée</option>
                            <?php
                            for ($i = 1; $i <= 24; $i++) {
                                $selected = isset($_POST['event_duration']) && $_POST['event_duration'] == $i ? 'selected' : '';
                                echo "<option value='$i' $selected>$i heure" . ($i > 1 ? 's' : '') . "</option>";
                            }
                            ?>
                        </select>

                        <label for="event_location">Lieu (Ville, Pays, Adresse)</label>
                        <input type="text" id="event_location" name="event_location" placeholder="Lieu (Ville, Pays, Adresse)" value="<?= htmlspecialchars($_POST['event_location'] ?? '') ?>"/>

                        <label for="event_type">Type d'Événement</label>
                        <select id="event_type" name="event_type">
                            <option value="" disabled <?= !isset($_POST['event_type']) ? 'selected' : '' ?>>Type d'Événement</option>
                            <?php
                            $eventTypes = ['Exposition', 'Lancement de Produit', 'Défilé', 'Gala'];
                            foreach ($eventTypes as $type) {
                                $selected = isset($_POST['event_type']) && $_POST['event_type'] == $type ? 'selected' : '';
                                echo "<option value='$type' $selected>$type</option>";
                            }
                            ?>
                        </select>

                        <label for="event_tasks">Tâches Spécifiques</label>
                        <select id="event_tasks" name="event_tasks">
                            <option value="" disabled <?= !isset($_POST['event_tasks']) ? 'selected' : '' ?>>Tâches Spécifiques</option>
                            <?php
                            $eventTasks = ['Accueil', 'Animation', 'Démonstration de Produits', 'Défilé'];
                            foreach ($eventTasks as $task) {
                                $selected = isset($_POST['event_tasks']) && $_POST['event_tasks'] == $task ? 'selected' : '';
                                echo "<option value='$task' $selected>$task</option>";
                            }
                            ?>
                        </select>

                        <label for="dress_code">Tenue Requise</label>
                        <select id="dress_code" name="dress_code">
                            <option value="" disabled <?= !isset($_POST['dress_code']) ? 'selected' : '' ?>>Tenue Requise</option>
                            <?php
                            $dressCodes = ['Uniforme', 'Vêtements Personnalisés', 'Casual', 'Formel'];
                            foreach ($dressCodes as $code) {
                                $selected = isset($_POST['dress_code']) && $_POST['dress_code'] == $code ? 'selected' : '';
                                echo "<option value='$code' $selected>$code</option>";
                            }
                            ?>
                    </select>

                        <!-- Submit -->
                    <button type="submit" name="reserve" class="send-btn">Réserver</button>
                </form>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var messageText = "<?= $_SESSION['status'] ?? ''; ?>";
            if (messageText != '') {
                Swal.fire({
                    title: "Parfait !",
                    text: messageText,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "models_and_hostesses.php";
                    }
                });

                <?php unset($_SESSION['status']); ?>
            }
        });
    </script>
</html>
