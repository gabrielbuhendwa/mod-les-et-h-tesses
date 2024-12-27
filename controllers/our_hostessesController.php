<?php
require('../database/db.php');

// Fetch the data from models_request table
try {
    $select_info = $bdd->query("SELECT * FROM hostesses ORDER BY approval_date DESC");
    $models = $select_info->fetchAll(PDO::FETCH_ASSOC);

    // Count total requests
    $total_models = count($models);
} catch (Exception $e) {
    die('Error fetching model requests: ' . $e->getMessage());
}
?>
