<?php
session_start(); 
require('../database/db.php');

//select categorie


if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Check if the id exists in models or hostesses
        $modelQuery = $bdd->prepare("SELECT * FROM models WHERE id = :id");
        $modelQuery->execute(['id' => $id]);
        $model = $modelQuery->fetch(PDO::FETCH_ASSOC);

        $hostessQuery = $bdd->prepare("SELECT * FROM hostesses WHERE id = :id");
        $hostessQuery->execute(['id' => $id]);
        $hostess = $hostessQuery->fetch(PDO::FETCH_ASSOC);

        if ($model) {
            $details = $model;
            $type = 'MODÈLES';
        } elseif ($hostess) {
            $details = $hostess;
            $type = 'HÔTESSES';
        } else {
            die('Aucun modèle ou hôtesse trouvé.');
        }

    } catch (Exception $e) {
        die('Une erreur a été trouvée : ' . $e->getMessage());
    }
} else {
    die('ID non fourni.');
}
