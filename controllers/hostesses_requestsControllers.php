<?php
require('../database/db.php');

// Fetch the data from models_request table
try {
    $select_request_info = $bdd->query("SELECT * FROM hostesses_requests ORDER BY request_date DESC");
    $hostesses_requests = $select_request_info->fetchAll(PDO::FETCH_ASSOC);

    // Count total requests
    $total_requests = count($hostesses_requests);
} catch (Exception $e) {
    die('Error fetching model requests: ' . $e->getMessage());
}
?>
