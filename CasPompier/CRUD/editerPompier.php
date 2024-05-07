<?php
// Inclure le fichier de connexion à la base de données
include_once '../include/connection.inc.php';
include_once '../classes/PompierManager.php';
// Création d'une instance de PompierManager
$pompierManager = new PompierManager($db);

// Vérification si un matricule a été fourni
$matricule = $_POST['matricule'] ?? null; // Ou utiliser $_GET['matricule'] si passé par URL

if ($matricule) {
    // Tentative de récupération du pompier correspondant au matricule
    $pompier = $pompierManager->getPompier($matricule);

    if (!$pompier) {
        // Gestion du cas où le pompier n'est pas trouvé
        echo "Pompier non trouvé.";
        exit;
    }
} else {
    // Gestion du cas où aucun matricule n'est fourni
    echo "Aucun matricule fourni.";
    exit;
}

// Traitement du formulaire de mise à jour
if (isset($_POST['update'])) {
    // Récupération des données du formulaire
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaiss = $_POST['date_naissance'];
    $tel = $_POST['telephone'];
    $sexe = $_POST['sexe'];
    $idGrade = $_POST['grade'];
    $caserne = $_POST['caserne'];

    // Mise à jour de l'objet pompier avec les nouvelles valeurs
    $pompier->setNomPompier($nom);
    $pompier->setPrenomPompier($prenom);
    $pompier->setDateNaissPompier($dateNaiss);
    $pompier->setTelPompier($tel);
    $pompier->setSexePompier($sexe);
    $pompier->setIdGrade($idGrade);
    $pompier->setCaserne($caserne);

    // Appel à PompierManager pour sauvegarder les modifications
    $result = $pompierManager->updatePompier($matricule, $nom, $prenom, $dateNaiss, $tel, $sexe, $idGrade, $caserne);

    if ($result) {
        // Redirection vers caserne.php en cas de succès
        header("Location: ../Caserne.php");
        exit;
    } else {
        // Affichage d'un message d'erreur en cas d'échec
        echo "Erreur lors de la mise à jour du pompier.";
    }
}

// Requête SQL pour récupérer les données de la table "grade"
$sql = "SELECT id, libellé FROM grade";
$result = $db->query($sql);

$sql = "SELECT id, Nom FROM caserne";
$result_caserne = $db->query($sql);

?>

<!-- Formulaire d'édition des informations du pompier -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Édition d'un Pompier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>





    <section class="bg-white dark:bg-gray-900">

        <div class="grid max-w-screen-xl h-screen px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Édite les informations du pompier 🧑‍🚒</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Utilisez le formulaire ci-dessous pour mettre à jour les informations relatives au pompier
                    sélectionné dans la base de données.
                </p>
                <a href="../caserne.php"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Caserne 🏢
                </a>
            </div>
            <?php if ($pompier): ?>
                <div class="lg:col-span-5 lg:flex place-self-center">
                    <form action="editerPompier.php" method="POST"
                        class="max-w-md mx-auto p-8 border border-gray-300 rounded-lg bg-white shadow-md">
                        <label for="matricule" class="block text-gray-700 font-semibold mb-2">Matricule:</label>
                        <input type="text" id="matricule" name="matricule"
                            value="<?php echo htmlspecialchars($pompier->getMatricule()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />

                        <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom:</label>
                        <input type="text" id="nom" name="nom"
                            value="<?php echo htmlspecialchars($pompier->getNomPompier()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />


                        <label for="prenom" class="block text-gray-700 font-semibold mb-2">Prénom:</label>
                        <input type="text" id="prenom" name="prenom"
                            value="<?php echo htmlspecialchars($pompier->getPrenomPompier()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />

                        <label for="datenaiss" class="block text-gray-700 font-semibold mb-2">Date de Naissance:</label>
                        <input type="date" id="date_naissance" name="date_naissance"
                            value="<?php echo htmlspecialchars($pompier->getDateNaissPompier()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />

                        <label for="tel" class="block text-gray-700 font-semibold mb-2">Téléphone:</label>
                        <input type="text" id="telephone" name="telephone"
                            value="<?php echo htmlspecialchars($pompier->getTelPompier()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />

                        <label for="sexe" class="block text-gray-700 font-semibold mb-2">Sexe:</label>
                        <select id="sexe" name="sexe"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="F" <?php echo $pompier->getSexePompier() == 'F' ? 'selected' : ''; ?>>Femme
                            </option>
                            <option value="M" <?php echo $pompier->getSexePompier() == 'M' ? 'selected' : ''; ?>>Homme
                            </option>
                        </select>

                        <label for="grade" class="block text-gray-700 font-semibold mb-2">Grade:</label>
                        <select id="grade" name="grade"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="" disabled <?php echo empty($pompier->getIdGrade()) ? 'selected' : ''; ?>>
                                Sélectionnez un grade</option>
                            <?php
                            // Générer dynamiquement les options du select pour les grades
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $pompier->getIdGrade() == $row["id"] ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($row["id"]) . '"' . $selected . '>' . htmlspecialchars($row["libellé"]) . '</option>';
                            }
                            ?>
                        </select>

                        <label for="caserne" class="block text-gray-700 font-semibold mb-2">Caserne:</label>
                        <select id="caserne" name="caserne"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="" disabled <?php echo empty($pompier->getCaserne()) ? 'selected' : ''; ?>>
                                Sélectionnez une caserne</option>
                            <?php
                            // Générer dynamiquement les options du select pour les casernes
                            while ($caserne = $result_caserne->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $pompier->getCaserne() == $caserne['id'] ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($caserne['id']) . '"' . $selected . '>' . htmlspecialchars($caserne['Nom']) . '</option>';
                            }
                            ?>
                        </select>

                        <button type="submit" name="update"
                            class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-300">Mettre
                            à jour</button>
                    </form>
                </div>
            <?php else: ?>
                <p>Aucun pompier trouvé pour ce matricule.</p>
            <?php endif; ?>

        </div>






    </section>
</body>


</html>