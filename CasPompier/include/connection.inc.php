<?php

$hote = "127.0.0.1:3306";
$bd = "caspompier";
$login = "root";
$motDePasse = "";
$error = null;

try {
    // Établir la connexion à la base de données
    $db = new PDO("mysql:host=$hote;dbname=$bd;charset=utf8", $login, $motDePasse);
    // Activer le mode d'affichage des erreurs PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Capturer l'exception PDO en cas d'erreur de connexion
    $error = "Erreur dans la connexion: " . $e->getMessage();
    // Afficher un message d'erreur
    echo "<div class='alert alert-danger'>$error</div>";
    // Arrêter l'exécution du script si la connexion échoue
    die();
}

// Si la connexion réussit, le reste du code peut être exécuté normalement

