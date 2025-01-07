<?php
try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=mhdb;charset=utf8;', 
        'gloire', 
        'Pat102030@@#', 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (Exception $e) {
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
?>