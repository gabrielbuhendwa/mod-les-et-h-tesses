<?php 
    require('../controllers/hostesses_requests_detailsController.php');

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
    <link rel="stylesheet" href="../asset/css/m&h_requestsdetails.css"/>
    <title>Models Request Details</title>
</head>
<body>
    
<div class="container">
    <div class="profile">
        <div class="id-card">
            <div class="id-photo" onclick="openLightbox()">
                <img src="../asset/images/models/<?= htmlspecialchars($request_details['id_card']) ?>" alt="ID Photo" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
            <h2 id="userName"><?= htmlspecialchars($request_details['first_name'] . ' ' . $request_details['last_name']) ?></h2>
        </div>

        <!-- Lightbox -->
        <div id="lightbox" class="lightbox">
            <div class="lightbox-content">
                <span class="close-btn" onclick="closeLightbox()">×</span>
                <img id="lightboxImage" src="../asset/images/models/<?= htmlspecialchars($request_details['id_card']) ?>" alt="ID Photo">
            </div>
        </div>
            
        <div class="info-section">
            <div class="info-grid" id="userInfo">
                <div class="info-item"><strong>Prénom :</strong> <?= htmlspecialchars($request_details['first_name']) ?></div>
                <div class="info-item"><strong>Nom :</strong> <?= htmlspecialchars($request_details['last_name']) ?></div>
                <div class="info-item"><strong>Date de naissance :</strong> <?= htmlspecialchars($request_details['birth_date']) ?></div>
                <div class="info-item"><strong>Ville :</strong> <?= htmlspecialchars($request_details['city']) ?></div>
                <div class="info-item"><strong>Code postal :</strong> <?= htmlspecialchars($request_details['code_number']) ?></div>
                <div class="info-item"><strong>Nationalité :</strong> <?= htmlspecialchars($request_details['nationality']) ?></div>
                <div class="info-item"><strong>Téléphone :</strong> <?= htmlspecialchars($request_details['phone']) ?></div>
                <div class="info-item"><strong>WhatsApp :</strong> <?= htmlspecialchars($request_details['whatsapp']) ?></div>
                <div class="info-item"><strong>Courriel :</strong> <?= htmlspecialchars($request_details['email']) ?></div>
                <div class="info-item"><strong>Instagram :</strong> <?= htmlspecialchars($request_details['instagram']) ?></div>
                <div class="info-item"><strong>Taille :</strong> <?= htmlspecialchars($request_details['height']) ?></div>
                <div class="info-item"><strong>Langues :</strong> <?= htmlspecialchars($request_details['languages']) ?></div>
                <div class="info-item"><strong>Cheveux :</strong> <?= htmlspecialchars($request_details['hair']) ?></div>
                <div class="info-item"><strong>Yeux :</strong> <?= htmlspecialchars($request_details['eye']) ?></div>
                <div class="info-item"><strong>Pointure de chaussures :</strong> <?= htmlspecialchars($request_details['shoes_size']) ?></div>
                <div class="info-item"><strong>Date de demande :</strong> <?= htmlspecialchars($request_details['request_date']) ?></div>
            </div>
        </div>
    </div>
    
    <div class="gallery">
        <div class="image-card">
            <img src="../asset/images/models/<?= htmlspecialchars($request_details['face_portrait']) ?>" alt="Face Portrait">
        </div>
        <div class="image-card">
            <img src="../asset/images/models/<?= htmlspecialchars($request_details['profile_portrait']) ?>" alt="Profile Portrait">
        </div>
        <div class="image-card">
            <img src="../asset/images/models/<?= htmlspecialchars($request_details['full_body_front_side']) ?>" alt="Full Body Front Side">
        </div>
        <div class="image-card">
            <img src="../asset/images/models/<?= htmlspecialchars($request_details['action_shot']) ?>" alt="Action Shot">
        </div>
    </div>

    <div class="action-buttons">
        <button class="action-button" style="background: #ff4444;" onclick="openDeleteModal()">
            <svg viewBox="0 0 24 24" fill="white">
                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
            </svg>
        </button>
        <button class="action-button" style="background: #34a853;" onclick="document.getElementById('validateModal').style.display='flex'">
            <svg viewBox="0 0 24 24" fill="white">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
        </button>
    </div>
</div>
           <!-- Validation Modal -->
    <div id="validateModal" class="modal">
            <div class="modal-content">
                <h3>Êtes-vous sûr de vouloir valider cette personne ?</h3>
            <form method="post" class="modal-buttons">
                <button type="button" class="modal-button no" onclick="document.getElementById('validateModal').style.display='none'">Non</button>
                <button type="submit" name="validate" class="modal-button yes">Oui</button>
            </form>
        </div>
    </div>
    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Êtes-vous sûr de vouloir rejeter cette candidature ?</h3>
            <div class="modal-buttons">
                <button class="modal-button no" onclick="closeDeleteModal()">Non</button>
                <button class="modal-button yes" onclick="showReasonTextarea()">Oui</button>
            </div>
            <div id="reasonContainer" style="display: none; margin-top: 20px;">
                <form method="post">
                    <textarea name="deleteReason" id="deleteReason" placeholder="Indiquez la raison du rejet ici..." required></textarea>
                    <button type="submit" name="reject" class="modal-button submit">Rejeter</button>
                </form>
            </div>
        </div>
    </div>
</body>
<!---------rejection logic----------->
<script>
    let isReasonVisible = false; // Track whether the textarea should be shown

    function showReasonTextarea() {
        // Show the textarea when "Yes" is clicked
        document.getElementById('reasonContainer').style.display = 'block';
        isReasonVisible = true; // Set the flag to true
    }

    function handleReasonSubmit() {
        const reason = document.getElementById('deleteReason').value.trim();

        // If reason is empty, alert the user (PHP will handle actual validation)
        if (!reason) {
            alert("Please provide a reason before rejecting.");
        } else {
            console.log("Reason for deletion:", reason); // Send to PHP for processing
            // After submission, hide the modal and reset the state
            document.getElementById('deleteModal').style.display = 'none';
            document.getElementById('deleteReason').value = ''; // Clear the textarea
            isReasonVisible = false; // Reset the visibility flag
        }
    }

    function openDeleteModal() {
        // Open the modal
        document.getElementById('deleteModal').style.display = 'flex';
        
        // Reset the textarea visibility to "none" when the modal is reopened
        document.getElementById('reasonContainer').style.display = 'none';
        isReasonVisible = false; // Reset the flag when reopening
    }

    function closeDeleteModal() {
        // Close the modal
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>
<!-----------------------identity card visibility------------------------->
<script>
        function openLightbox() {
        var lightbox = document.getElementById('lightbox');
        var lightboxImage = document.getElementById('lightboxImage');
        var imageSrc = document.querySelector('.id-photo img').src; // Get the source of the image clicked

        lightboxImage.src = imageSrc; // Set the source to the image clicked
        lightbox.style.display = 'flex'; // Show the lightbox
    }

    function closeLightbox() {
        var lightbox = document.getElementById('lightbox');
        lightbox.style.display = 'none'; // Hide the lightbox
    }
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
                        window.location.href = "hostesses_requests.php";
                    }
                });

                <?php unset($_SESSION['status']); ?>
            }
        });
    </script>
</html>
