<?php 
    require('../controllers/partnersController.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/dasboard.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Our Partner</title>
</head>
<body>
    <button class="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </button>

    <?php include '../includes/sidebar.php'?>

    <div class="main-content">
        <section class="partners">
            <?php
                try {
                    // Retrieve partners from the database
                    $query = $bdd->query('SELECT * FROM partners ORDER BY id DESC');
                    $partners = $query->fetchAll(PDO::FETCH_ASSOC);

                    // Count the total number of partners
                    $totalPartners = count($partners);
            ?>
            <h2>Nos Partenaires (<?php echo $totalPartners; ?>)</h2>
            <div class="partners-container">
                <?php if ($totalPartners > 0): ?>
                    <?php foreach ($partners as $partner): ?>
                        <div class="partner-card">
                            <div class="partner-logo">
                                <img src="../asset/images/partners/<?php echo htmlspecialchars($partner['photo']); ?>" alt="<?php echo htmlspecialchars($partner['name']); ?> Logo">
                            </div>
                            <h3><?php echo htmlspecialchars($partner['name']); ?></h3>
                            <p><?php echo htmlspecialchars($partner['description']); ?></p>
                            <div class="action-buttons">
                                <button class="action-button" style="background: #fb8c00;" onclick="window.location.href='edit_partner.php?id=<?php echo $partner['id']; ?>'">
                                    <svg viewBox="0 0 24 24" fill="white">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </button>

                                <button class="action-button" style="background: #ff4444;" onclick="openDeleteModal(<?php echo $partner['id']; ?>)">
                                    <svg viewBox="0 0 24 24" fill="white">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun partenaire trouvé.</p>
                <?php endif; ?>
            </div>
            <?php
            } catch (Exception $e) {
                echo "<p>Erreur lors de la récupération des partenaires : " . $e->getMessage() . "</p>";
            }
            ?>
        </section>
        <section class="reservation-button">
            <div class="button-container">
                <button onclick="window.location.href='add_partner.php'">Ajouter un Partenaire</button>
            </div>
        </section>

        <!-- Delete Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h3>Êtes-vous sûr de vouloir supprimer ce partenaire?</h3>
                <form action="" method="POST">
                    <!-- Hidden Input to Store Partner ID -->
                    <input type="hidden" id="deletePartnerId" name="id" value="">
                    <div class="modal-buttons">
                        <button type="button" class="modal-button no" onclick="closeDeleteModal()">Non</button>
                        <button type="submit" name="delete_partner" class="modal-button yes">Oui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    // Toggle sidebar functionality
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });

    // Modal open/close functions
    function openDeleteModal(partnerId) {
        // Populate the hidden input with the partner ID
        document.getElementById('deletePartnerId').value = partnerId;

        // Display the modal
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'flex';
    }

    function closeDeleteModal() {
        // Hide the modal
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'none';
    }
    </script>

</body>
</html>
