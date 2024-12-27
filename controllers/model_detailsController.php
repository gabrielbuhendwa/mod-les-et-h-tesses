<?php
session_start();
require('../database/db.php');

// Check if an ID is passed
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Invalid model ID.');
}

$model_id = intval($_GET['id']);

// Handle Delete Action
if (isset($_POST['delete_model'])) {
    $model_id = intval($_POST['id']);

    try {
        // Delete the model from the database
        $query = $bdd->prepare("DELETE FROM models WHERE id = :id");
        $query->bindParam(':id', $model_id, PDO::PARAM_INT);
            
        if ($query->execute()) {
            
        } else {
            $_SESSION['status'] = "La suppression du modèle a échoué.";
        }
    } catch (Exception $e) {
        $_SESSION['status'] = "Erreur: " . $e->getMessage();
    }

    // Redirect immediately
    header("Location: ../admin/our_models.php");
    exit();
}

// Fetch the specific model details
try {
    $query = $bdd->prepare("SELECT * FROM models WHERE id = :id");
    $query->bindParam(':id', $model_id, PDO::PARAM_INT);
    $query->execute();
    $request_details = $query->fetch(PDO::FETCH_ASSOC);

    if (!$request_details) {
        die('Model not found.');
    }
} catch (Exception $e) {
    die('Error fetching model details: ' . $e->getMessage());
}
?>
