<?php 
    
    require('../controllers/modelsController.php');

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
  <title>Inscription Modèles</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../asset/css/modèle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>    
</head>
<body>
<?php include '../includes/head.php'?>
  <section class="hero-section">
  <div class="form-container">
    <h1>S'inscrire comme Modèle</h1>
    <?php if (isset($error)) { ?>
        <div style="text-align: center; color: red;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php } ?>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
            <div class="form-group">
                <label for="gender">Sex:</label>
                <select id="gender" name="gender">
                    <option value="" disabled <?= empty($_POST['gender']) ? 'selected' : '' ?>>Sélectionnez votre sexe</option>
                    <option value="Feminin" <?= isset($_POST['gender']) && $_POST['gender'] === 'Feminin' ? 'selected' : '' ?>>Feminin</option>
                    <option value="Masculin" <?= isset($_POST['gender']) && $_POST['gender'] === 'Masculin' ? 'selected' : '' ?>>Masculin</option>
                </select>

                <label for="first-name">Prénom:</label>
                <input type="text" id="first-name" name="first-name" value="<?= htmlspecialchars($_POST['first-name'] ?? '') ?>">

                <label for="last-name">Nom de famille:</label>
                <input type="text" id="last-name" name="last-name" value="<?= htmlspecialchars($_POST['last-name'] ?? '') ?>">

                <label for="birthdate">Date de naissance:</label>
                <div class="birthdate-fields">
                    <select id="day" name="birth-day">
                        <option value="" disabled <?= empty($_POST['birth-day']) ? 'selected' : '' ?>>Jour</option>
                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                            <option value="<?= $i ?>" <?= isset($_POST['birth-day']) && (int)$_POST['birth-day'] === $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php } ?>
                    </select>
                    <select id="month" name="birth-month">
                        <option value="" disabled <?= empty($_POST['birth-month']) ? 'selected' : '' ?>>Mois</option>
                        <?php 
                        $months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
                        foreach ($months as $index => $month) { ?>
                            <option value="<?= $index + 1 ?>" <?= isset($_POST['birth-month']) && (int)$_POST['birth-month'] === $index + 1 ? 'selected' : '' ?>><?= $month ?></option>
                        <?php } ?>
                    </select>
                    <select id="year" name="birth-year">
                        <option value="" disabled <?= empty($_POST['birth-year']) ? 'selected' : '' ?>>Année</option>
                        <?php for ($i = 1970; $i <= 2015; $i++) { ?>
                            <option value="<?= $i ?>" <?= isset($_POST['birth-year']) && (int)$_POST['birth-year'] === $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label for="city">Ville:</label>
                <input type="text" id="city" name="city" value="<?= htmlspecialchars($_POST['city'] ?? '') ?>">

                <label for="code">Nom de Code (Ex : AB123):</label>
                <input type="text" id="code" name="code" value="<?= htmlspecialchars($_POST['code'] ?? '') ?>">

                <label for="country">Nationalité:</label>
                <input type="text" id="country" name="country" value="<?= htmlspecialchars($_POST['country'] ?? '') ?>">

                <label for="phone">Téléphone (Ex : +33 ...):</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp (Ex : +33 ...):</label>
                <input type="text" id="whatsapp" name="whatsapp" value="<?= htmlspecialchars($_POST['whatsapp'] ?? '') ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

                <label for="instagram">Nom Instagram:</label>
                <input type="text" id="instagram" name="instagram" value="<?= htmlspecialchars($_POST['instagram'] ?? '') ?>">

                <label for="height">Taille:</label>
                <select id="height" name="height">
                    <option value="" disabled <?= empty($_POST['height']) ? 'selected' : '' ?>>Sélectionnez votre taille</option>
                    <?php 
                    for ($cm = 150; $cm <= 200; $cm++) { 
                    ?>
                        <option value="<?= $cm ?> cm" <?= isset($_POST['height']) && $_POST['height'] === "{$cm} cm" ? 'selected' : '' ?>><?= $cm ?> cm</option>
                    <?php } ?>
                </select>

                
                <label for="languages">Langues (jusqu'à 3):</label>
                <div class="birthdate-fields">
                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                        <select id="language-group-<?= $i ?>" name="language-<?= $i ?>">
                            <option value="" disabled <?= empty($_POST["language-$i"]) ? 'selected' : '' ?>>Sélectionnez une langue</option>
                            <?php 
                            $languages = [
                                "Anglais", "Mandarin", "Hindi", "Espagnol", "Français",
                                "Arabe", "Bengali", "Russe", "Portugais", "Urdu",
                                "Swahili", "Allemand", "Japonais", "Coréen", "Turc",
                                "Hausa", "Amharique", "Oromo", "Yoruba", "Igbo",
                                "Shona", "Zulu", "Xhosa", "Somali", "Peul",
                                "Indonésien", "Marathi", "Telugu", "Tamil", "Kinyarwanda"
                            ];                            
                            foreach ($languages as $language) { ?>
                                <option value="<?= $language ?>" <?= isset($_POST["language-$i"]) && $_POST["language-$i"] === $language ? 'selected' : '' ?>><?= $language ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                </div>
                
                <label for="hair">Cheveux:</label>
                <select id="hair" name="hair">
                    <option value="" disabled <?= empty($_POST['hair']) ? 'selected' : '' ?>>Sélectionnez la couleur</option>
                    <option value="Noir" <?= isset($_POST['hair']) && $_POST['hair'] === 'Noir' ? 'selected' : '' ?>>Noir</option>
                    <option value="Blond" <?= isset($_POST['hair']) && $_POST['hair'] === 'Blond' ? 'selected' : '' ?>>Blond</option>
                    <option value="Marron" <?= isset($_POST['hair']) && $_POST['hair'] === 'Marron' ? 'selected' : '' ?>>Marron</option>
                    <option value="Bleu" <?= isset($_POST['hair']) && $_POST['hair'] === 'Bleu' ? 'selected' : '' ?>>Bleu</option>
                    <option value="Vert" <?= isset($_POST['hair']) && $_POST['hair'] === 'Vert' ? 'selected' : '' ?>>Vert</option>
                    <option value="Gris" <?= isset($_POST['hair']) && $_POST['hair'] === 'Gris' ? 'selected' : '' ?>>Gris</option>
                    <option value="Noisette" <?= isset($_POST['hair']) && $_POST['hair'] === 'Noisette' ? 'selected' : '' ?>>Noisette</option>
                    <option value="Ambre" <?= isset($_POST['hair']) && $_POST['hair'] === 'Ambre' ? 'selected' : '' ?>>Ambre</option>
                </select>

                <label for="eye">Yeux:</label>
                <select id="eye" name="eye">
                    <option value="" disabled <?= empty($_POST['eye']) ? 'selected' : '' ?>>Sélectionnez la couleur</option>
                    <option value="Marron" <?= isset($_POST['eye']) && $_POST['eye'] === 'Marron' ? 'selected' : '' ?>>Marron</option>
                    <option value="Noir" <?= isset($_POST['eye']) && $_POST['eye'] === 'Noir' ? 'selected' : '' ?>>Noir</option>
                    <option value="Brun" <?= isset($_POST['eye']) && $_POST['eye'] === 'Brun' ? 'selected' : '' ?>>Brun</option>
                    <option value="Châtain" <?= isset($_POST['eye']) && $_POST['eye'] === 'Châtain' ? 'selected' : '' ?>>Châtain</option>
                    <option value="Bleu" <?= isset($_POST['eye']) && $_POST['eye'] === 'Bleu' ? 'selected' : '' ?>>Bleu</option>
                    <option value="Vert" <?= isset($_POST['eye']) && $_POST['eye'] === 'Vert' ? 'selected' : '' ?>>Vert</option>
                    <option value="Gris" <?= isset($_POST['eye']) && $_POST['eye'] === 'Gris' ? 'selected' : '' ?>>Gris</option>
                    <option value="Violet" <?= isset($_POST['eye']) && $_POST['eye'] === 'Violet' ? 'selected' : '' ?>>Violet</option>
                </select>


                <label for="shoes">Pointure:</label>
                    <select id="shoe-size" name="shoe-size">
                        <option value="" disabled <?= empty($_POST['shoe-size']) ? 'selected' : '' ?>>Sélectionnez votre pointure</option>
                        <?php
                        // Array of shoe sizes in EU and corresponding US sizes
                        $shoeSizes = [
                            ["eu" => 35, "us" => 4], ["eu" => 36, "us" => 5], ["eu" => 37, "us" => 6],
                            ["eu" => 38, "us" => 7], ["eu" => 39, "us" => 8], ["eu" => 40, "us" => 9],
                            ["eu" => 41, "us" => 10], ["eu" => 42, "us" => 11], ["eu" => 43, "us" => 12],
                            ["eu" => 44, "us" => 13], ["eu" => 45, "us" => 14], ["eu" => 46, "us" => 15],
                            ["eu" => 47, "us" => 16], ["eu" => 48, "us" => 17], ["eu" => 49, "us" => 18],
                            ["eu" => 50, "us" => 19], ["eu" => 51, "us" => 20], ["eu" => 52, "us" => 21],
                            ["eu" => 53, "us" => 22], ["eu" => 54, "us" => 23]
                        ];
                        foreach ($shoeSizes as $size) {
                            $value = "{$size['eu']} - {$size['us']}";
                            $selected = isset($_POST['shoe-size']) && $_POST['shoe-size'] === $value ? 'selected' : '';
                            echo "<option value=\"$value\" $selected>{$size['eu']} (EU) - {$size['us']} (US)</option>";
                        }
                        ?>
                    </select>
            </div>
            
        </div>
        <p class="upload-guide">
        Pour finaliser votre inscription, merci de fournir une pièce d’identité (carte nationale ou permis de conduire) ainsi que 5 photos naturelles (sans maquillage ni filtre) : portrait face, portrait profil, corps entier (face et profil), et une photo en mouvement.
            </p>
            <div class="file-upload-section">
                <div class="file-upload-item">
                    <label for="close-up">Pièce D’identité</label>
                    <input type="file" id="close-up" name="id_card" accept="image/*">
                    <div class="upload-icon">
                        <i class="fa-solid fa-upload"></i>
                    </div>
                </div>
                
                <div class="file-upload-item">
                    <label for="close-up">Portrait face</label>
                    <input type="file" id="close-up" name="face" accept="image/*">
                    <div class="upload-icon">
                        <i class="fa-solid fa-upload"></i>
                    </div>
                </div>

                <div class="file-upload-item">
                    <label for="close-up">Portrait profil</label>
                    <input type="file" id="close-up" name="profil" accept="image/*">
                    <div class="upload-icon">
                        <i class="fa-solid fa-upload"></i>
                    </div>
                </div>

                <div class="file-upload-item">
                    <label for="close-up">Corps entier de face et de profil</label>
                    <input type="file" id="close-up" name="front" accept="image/*">
                    <div class="upload-icon">
                        <i class="fa-solid fa-upload"></i>
                    </div>
                </div>

                <div class="file-upload-item">
                    <label for="close-up">Photo en mouvement</label>
                    <input type="file" id="close-up" name="action" accept="image/*">
                    <div class="upload-icon">
                        <i class="fa-solid fa-upload"></i>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="submit-btn">Soumettre l'inscription</button>
        </form>
    </div>
    </section>
    <?php include '../includes/footer.php'?>
</body>
<script>
    document.querySelectorAll('.file-upload-item input[type="file"]').forEach(input => {
    input.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const parent = input.parentElement;
                let img = parent.querySelector('img');

                if (!img) {
                    img = document.createElement('img');
                    img.style.position = 'absolute';
                    img.style.top = '0';
                    img.style.left = '0';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover'; // Maintain aspect ratio and cover the container
                    parent.appendChild(img);
                }
                img.src = e.target.result; // Set the uploaded image as the preview

                // Hide the upload icon when an image is displayed
                const icon = parent.querySelector('.upload-icon');
                if (icon) icon.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
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
                        window.location.href = "../index.php";
                    }
                });

                <?php unset($_SESSION['status']); ?>
            }
        });
    </script>
</html>
