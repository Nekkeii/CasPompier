<?php
// Inclure le fichier de connexion à la base de données
include_once '../include/connection.inc.php';
include_once '../classes/PompierManager.php';

if (isset($_POST['delete']) && !empty($_POST['matricule'])) {
    $matricule = $_POST['matricule']; // Récupérer le matricule du formulaire

    // Créer une instance de PompierManager avec la connexion à la base de données
    $manager = new PompierManager($db);

    // Appeler la méthode deletePompier
    $result = $manager->deletePompier($matricule);

    if ($result['success']) {
        // Redirection vers Caserne.php avec un paramètre de succès si la suppression a réussi
        header('Location: ../Caserne.php?success=deletion');
        exit;
    } else {
        // Affichage de l'erreur si la suppression a échoué
        header('Location: ../Caserne.php?error=deletionfailed&message=' . urlencode($result['message']));
        exit;
    }
} else {
    // Redirection vers Caserne.php avec un paramètre d'erreur si le matricule n'est pas fourni
    header('Location: ../Caserne.php?error=nomatricule');
    exit;
}