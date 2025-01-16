<?php 
    require('../controllers/hostesses_detailsController.php');

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
    <title>Models Details</title>
</head>
<body>
<div class="container">
    <div class="profile">
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
                <div class="info-item"><strong>Date de demande :</strong> <?= htmlspecialchars($request_details['approval_date']) ?></div>
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
        <button class="action-button" style="background: #25d366;" onclick="handleWhatsApp('<?php echo $request_details['whatsapp']; ?>')">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24" height="24" fill="white">
            <path d="M16 0a16 16 0 0 0-16 16c0 2.823.737 5.607 2.137 8.051l-1.428 5.196 5.345-1.388A15.911 15.911 0 0 0 16 32a16 16 0 0 0 16-16c0-8.837-7.163-16-16-16zm0 29.684c-2.577 0-5.093-.667-7.333-1.94l-.51-.286-3.179.826.853-3.103-.309-.522A13.918 13.918 0 0 1 2.318 16c0-7.532 6.15-13.684 13.682-13.684 7.532 0 13.684 6.152 13.684 13.684 0 7.532-6.152 13.684-13.684 13.684zm7.28-10.946c-.39-.194-2.298-1.135-2.652-1.264-.355-.13-.614-.194-.874.195-.259.39-1.006 1.264-1.233 1.523-.227.26-.454.292-.843.097-.39-.195-1.645-.606-3.136-1.932-1.158-1.027-1.94-2.3-2.173-2.69-.23-.39-.024-.598.173-.792.177-.175.39-.454.585-.682.194-.228.26-.39.39-.649.129-.26.065-.487-.032-.682-.097-.195-.874-2.112-1.198-2.885-.316-.762-.637-.658-.874-.658h-.716c-.26 0-.683.097-1.04.487-.356.39-1.363 1.332-1.363 3.249 0 1.917 1.394 3.772 1.59 4.034.195.26 2.746 4.182 6.654 5.864.93.4 1.653.63 2.22.806.933.295 1.782.253 2.457.154.75-.116 2.298-.938 2.623-1.845.325-.906.325-1.682.227-1.845-.097-.162-.355-.259-.745-.454z"/>
        </svg>
    </button>

    <button class="action-button" style="background: #4285f4;" onclick="handleEmail('<?php echo $request_details['email']; ?>')">
        <svg viewBox="0 0 24 24" fill="white">
            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
        </svg>
    </button>

    <button class="action-button" style="background: #ff4444;" onclick="openDeleteModal()">
        <svg viewBox="0 0 24 24" fill="white">
            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
        </svg>
    </button>
    </div>
</div>
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Êtes-vous sûr de vouloir supprimer cette hôtesse ?</h3>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $request_details['id']; ?>">
                <div class="modal-buttons">
                    <button type="button" class="modal-button no" onclick="closeDeleteModal()">Non</button>
                    <button type="submit" name="delete_model" class="modal-button yes">Oui</button>
                </div>
            </form>
        </div>
    </div>
</body>
<!---------rejection logic----------->
<script>
    // Handle WhatsApp Button
    function handleWhatsApp(whatsappNumber) {
    if (!whatsappNumber) {
        alert("WhatsApp number is missing for this model.");
        return;
    }
    const whatsappUrl = `https://wa.me/${whatsappNumber}`;
    window.open(whatsappUrl, '_blank');
}

    // Handle Email Button (Open Gmail)
    function handleEmail(email) {
        if (!email) {
            alert("Email address is missing for this model.");
            return;
        }
        const emailSubject = "Message from Modeles et Hotesses";
        const emailBody = "Hello, we would like to discuss further details with you.";
        const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=${email}&su=${encodeURIComponent(emailSubject)}&body=${encodeURIComponent(emailBody)}`;
        window.open(gmailUrl, '_blank');
    }

    // Handle Delete Modal
    function openDeleteModal() {
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

</script>

</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</html>
