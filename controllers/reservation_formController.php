<?php
session_start();
require('../database/db.php');
require('mailer.php');

// Ensure user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: ../pages/login.php');
    exit;
}

// Fetch client details
$userId = $_SESSION['id'];
$clientQuery = $bdd->prepare("SELECT first_name, last_name, email, telephone FROM users WHERE id = ?");
$clientQuery->execute([$userId]);
$client = $clientQuery->fetch(PDO::FETCH_ASSOC);

// Fetch model or hostess details
$modelId = $_GET['id'] ?? null;
$table = $_GET['type'] ?? null; // "type" parameter specifies "models" or "hostesses"

if ($modelId && $table) {
    if ($table === 'models') {
        $query = "SELECT CONCAT(first_name, ' ', last_name) AS full_name, email FROM models WHERE id = ?";
    } elseif ($table === 'hostesses') {
        $query = "SELECT CONCAT(first_name, ' ', last_name) AS full_name, email FROM hostesses WHERE id = ?";
    } else {
        $error = "Type invalide spécifié.";
        $model = null;
    }

    if (!isset($error)) {
        $stmt = $bdd->prepare($query);
        $stmt->execute([$modelId]);
        $model = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$model) {
            $error = "Aucun modèle ou hôtesse trouvé avec cet ID.";
        }
    }
} else {
    $error = "Aucun ID ou type fourni pour le modèle/hôtesse.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract and validate form inputs
    $eventName = $_POST['event_name'] ?? '';
    $eventStart = $_POST['event_start'] ?? '';
    $eventEnd = $_POST['event_end'] ?? '';
    $eventTime = $_POST['event_time'] ?? '';
    $eventDuration = $_POST['event_duration'] ?? '';
    $eventLocation = $_POST['event_location'] ?? '';
    $eventType = $_POST['event_type'] ?? '';
    $eventTasks = $_POST['event_tasks'] ?? '';
    $dressCode = $_POST['dress_code'] ?? '';

    if (
        !empty($eventName) &&
        !empty($eventStart) &&
        !empty($eventEnd) &&
        !empty($eventTime) &&
        !empty($eventDuration) &&
        !empty($eventLocation) &&
        !empty($eventType) &&
        !empty($eventTasks) &&
        !empty($dressCode)
    ) {
        // All fields are filled; send email to admin
        $adminEmail = "generalconsultinggroupltd@gmail.com"; // Replace with the correct admin email
        $mail = require('mailer.php');

        try {
            // Set up email details
            $mail->setFrom($client['email'], $client['first_name'] . ' ' . $client['last_name']);
            $mail->addAddress($adminEmail);
            $mail->addReplyTo($client['email'], $client['first_name'] . ' ' . $client['last_name']);

            $mail->Subject = $table === 'models' ? "Nouvelle Réservation de Modèle" : "Nouvelle Réservation d'Hôtesse";
            $mail->isHTML(true);
            $mail->Body = "
                <h3>Détails de la Réservation</h3>
                <p><strong>Nom du Client:</strong> {$client['first_name']} {$client['last_name']}</p>
                <p><strong>Email du Client:</strong> {$client['email']}</p>
                <p><strong>Téléphone du Client:</strong> {$client['telephone']}</p>
                <p><strong>Nom du " . ($table === 'models' ? 'Modèle' : 'l\'Hôtesse') . ":</strong> {$model['full_name']}</p>
                <p><strong>Email du " . ($table === 'models' ? 'Modèle' : 'l\'Hôtesse') . ":</strong> {$model['email']}</p>
                <p><strong>Nom de l'Événement:</strong> {$eventName}</p>
                <p><strong>Date de Début:</strong> {$eventStart}</p>
                <p><strong>Date de Fin:</strong> {$eventEnd}</p>
                <p><strong>Debut de Prestation:</strong> {$eventTime}</p>
                <p><strong>Durée:</strong> {$eventDuration} heure" . ($eventDuration > 1 ? 's' : '') . "</p>
                <p><strong>Lieu:</strong> {$eventLocation}</p>
                <p><strong>Type d'Événement:</strong> {$eventType}</p>
                <p><strong>Tâches Spécifiques:</strong> {$eventTasks}</p>
                <p><strong>Tenue Requise:</strong> {$dressCode}</p>
            ";

            $mail->send();
            $_SESSION['status'] = "Réservation réussie ! Consultez votre email pour les prochaines étapes.";
            echo '<script>
            setTimeout(function() {
                window.location.href = "../pages/models_and_hostesses.php";
            }, 9000);
        </script>';
        } catch (Exception $e) {
            $error = "Erreur lors de l'envoi de l'email: " . $mail->ErrorInfo;
        }
    } else {
        // Handle errors: set the error message for missing fields
        $error = "Complétez l'ensemble du processus, s'il vous plaît.";
    }
}
?>
