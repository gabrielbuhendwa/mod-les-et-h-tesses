<?php
    session_start(); 
    require('../database/db.php');
    
    //security to handle connection before accessing this page
    // Check if user is authenticated
    if (!isset($_SESSION['id'])) {
        header('Location: ../pages/login.php');
        exit;
    } 

try {
    // Fetch data from models table
    $modelsQuery = $bdd->query("SELECT * FROM models ORDER BY id DESC");
    $models = $modelsQuery->fetchAll(PDO::FETCH_ASSOC);

    // Fetch data from hostesses table
    $hostessesQuery = $bdd->query("SELECT * FROM hostesses ORDER BY id DESC");
    $hostesses = $hostessesQuery->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
