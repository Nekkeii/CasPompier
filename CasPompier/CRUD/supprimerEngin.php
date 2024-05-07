<?php
// deleteEngin.php
include_once '../include/connection.inc.php';// Assurez-vous du chemin d'accès
include_once '../classes/EnginManager.php';   // Assurez-vous du chemin d'accès

if (isset($_POST['delete']) && !empty($_POST['numero'])) {
    $numero = $_POST['numero'];// Récupérer le matricule du formulaire

    // Créer une instance de EnginManager avec la connexion à la base de données
    $manager = new EnginManager($db);

    // Appeler la méthode deleteEngin
    $success = $manager->delete($numero);

    if ($success) {
        // Redirection vers CaserneEngin.php avec un paramètre de succès si la suppression a réussi
        header('Location: ../CaserneEngin.php?success=deletion');
        exit;
    } else {
        // Redirection vers CaserneEngin.php avec un paramètre d'erreur si la suppression a échoué
        header('Location: ../CaserneEngin.php?error=deletionfailed');
        exit;
    }
} else {
    // Redirection vers CaserneEngin.php avec un paramètre d'erreur si le matricule n'est pas fourni
    header('Location: ../CaserneEngin.php?error=nomatricule');
    exit;
}

