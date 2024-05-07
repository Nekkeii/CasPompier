<?php
// Inclure le fichier de connexion à la base de données
include_once '../include/connection.inc.php';
include_once '../classes/PompierManager.php';

if (isset($_POST['matricule']) && !empty($_POST['matricule'])) {
    $matricule = $_POST['matricule']; // Récupérer le matricule du formulaire

    // Créer une instance de PompierManager avec la connexion à la base de données
    $manager = new PompierManager($db);

    // Appeler une nouvelle méthode restaurerPompier() dans PompierManager pour restaurer le pompier
    $result = $manager->restaurerPompier($matricule);

    // Vérifier si la restauration du pompier a réussi
    if ($result['success']) {
        // Redirection vers caserne.php avec un message de succès
        header('Location: ../caserne.php?success=restoration');
        exit;
    } else {
        // Redirection vers caserne.php avec un message d'erreur si la restauration a échoué
        header('Location: ../caserne.php?error=restorationfailed&message=' . urlencode($result['message']));
        exit;
    }
} else {
    // Redirection vers caserne.php avec un message d'erreur si le matricule n'est pas fourni
    header('Location: ../caserne.php?error=nomatricule');
    exit;
}

