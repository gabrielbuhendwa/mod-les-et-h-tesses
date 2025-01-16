<?php
require('../database/db.php');
require('mailer.php');

// Check if an ID is passed via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Invalid request ID.');
}

$request_id = intval($_GET['id']);

try {
    // Fetch the specific request from the database
    $query = $bdd->prepare("SELECT * FROM models_request WHERE id = :id");
    $query->bindParam(':id', $request_id, PDO::PARAM_INT);
    $query->execute();
    $request_details = $query->fetch(PDO::FETCH_ASSOC);

    if (!$request_details) {
        die('Request not found.');
    }
} catch (Exception $e) {
    die('Error fetching request details: ' . $e->getMessage());
}

// Handle validation logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validate'])) {
    try {
        // Begin transaction
        $bdd->beginTransaction();

        // Insert validated data into `models` table
        $insert = $bdd->prepare("
            INSERT INTO models (
                first_name, last_name, birth_date, city, code_number,
                nationality, phone, whatsapp, email, instagram, height,
                languages, hair, eye, shoes_size, face_portrait, 
                profile_portrait, full_body_front_side, action_shot, approval_date
            ) VALUES (
                :first_name, :last_name, :birth_date, :city, :code_number,
                :nationality, :phone, :whatsapp, :email, :instagram, :height,
                :languages, :hair, :eye, :shoes_size, :face_portrait, 
                :profile_portrait, :full_body_front_side, :action_shot, NOW()
            )
        ");

        // Bind parameters
        $insert->execute([
            ':first_name' => $request_details['first_name'],
            ':last_name' => $request_details['last_name'],
            ':birth_date' => $request_details['birth_date'],
            ':city' => $request_details['city'],
            ':code_number' => $request_details['code_number'],
            ':nationality' => $request_details['nationality'],
            ':phone' => $request_details['phone'],
            ':whatsapp' => $request_details['whatsapp'],
            ':email' => $request_details['email'],
            ':instagram' => $request_details['instagram'],
            ':height' => $request_details['height'],
            ':languages' => $request_details['languages'],
            ':hair' => $request_details['hair'],
            ':eye' => $request_details['eye'],
            ':shoes_size' => $request_details['shoes_size'],
            ':face_portrait' => $request_details['face_portrait'],
            ':profile_portrait' => $request_details['profile_portrait'],
            ':full_body_front_side' => $request_details['full_body_front_side'],
            ':action_shot' => $request_details['action_shot']
        ]);

        // Delete the request from `models_request`
        $delete = $bdd->prepare("DELETE FROM models_request WHERE id = :id");
        $delete->bindParam(':id', $request_id, PDO::PARAM_INT);
        $delete->execute();

        // Commit transaction
        $bdd->commit();

        // Send notification email
        $mail->setFrom('noreply@modeles-et-hotesses.com', 'Modeles et Hotesses');
        $mail->addAddress($request_details['email']);
        $mail->CharSet = 'UTF-8'; // Définit l'encodage des caractères à UTF-8
        $mail->Subject = 'Félicitations ! Vous êtes maintenant accepté(e)';
        $mail->Body = "<p>Bonjour <strong>{$request_details['first_name']} {$request_details['last_name']}</strong>,</p>
                        <p>Nous sommes ravis de vous informer que votre demande a été approuvée ! Vous faites désormais partie de nos modèles officiels chez <strong>Models & Hostesses by General Consulting Group</strong>.</p>
                        <p>Votre profil est désormais visible dans notre galerie, où les utilisateurs peuvent vous découvrir et effectuer des demandes de réservation.</p>
                        <p>Bienvenue dans notre équipe ! Nous sommes heureux de vous compter parmi nous et vous souhaitons beaucoup de succès.</p>
                        <p>Cordialement,</p>
                        <p>L'équipe <strong>Models & Hostesses by General Consulting Group</strong></p>";

        $mail->send();

        $_SESSION['status'] = "La candidature a été validée avec succès. Le candidat(e) a été informé(e) et est désormais visible dans la galerie et accessible pour les réservations.";
                                echo '<script>
                                        setTimeout(function() {
                                            window.location.href = "../admin/models_requests.php";
                                        }, 12000);
                                    </script>';
    } catch (Exception $e) {
        $bdd->rollBack();
        die('Error during validation: ' . $e->getMessage());
    }
}


    //handle rejection logic as well 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reject'])) {
    try {
        $reason = trim($_POST['deleteReason']);

        if (empty($reason)) {
            throw new Exception('A rejection reason must be provided.');
        }

        // Delete the request from `models_request`
        $delete = $bdd->prepare("DELETE FROM models_request WHERE id = :id");
        $delete->bindParam(':id', $request_id, PDO::PARAM_INT);
        $delete->execute();

        // Send rejection email
        $mail->setFrom('noreply@modeles-et-hotesses.com', 'Modeles et Hotesses');
        $mail->addAddress($request_details['email']);
        $mail->CharSet = 'UTF-8'; // Définit l'encodage des caractères à UTF-8
        $mail->Subject = 'Notification de rejet : Candidature modèle';
        $mail->Body = "<p>Bonjour <strong>{$request_details['first_name']} {$request_details['last_name']}</strong>,</p>
               <p>Nous avons le regret de vous informer que votre candidature a été rejetée pour la raison suivante :</p>
               <p><em>{$reason}</em></p>
               <p>Nous vous encourageons à prendre en compte les points mentionnés et à postuler à nouveau à l'avenir.</p>
               <p>Cordialement,</p>
               <p>L'équipe <strong>Models & Hostesses by General Consulting Group</strong></p>";

        $mail->send();

        // Success message and redirection
        $_SESSION['status'] = "La candidature a été rejetée avec succès, et le candidat(e) a été informé(e).";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "../admin/models_requests.php";
                }, 9000);
              </script>';
    } catch (Exception $e) {
        die('Error during rejection: ' . $e->getMessage());
    }
}
?>