<?php
session_start();

// Vérification si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Rediriger l'utilisateur vers la page d'authentification
    header("Location: ../authentification.php");
    exit();
}

?>

<?php
// Inclure le fichier de connexion à la base de données
include_once '../include/connection.inc.php';
include_once '../classes/EnginManager.php';

// Créer une instance de EnginManager
$enginManager = new EnginManager($db);

// Vérifier si un numéro de moteur est fourni
$numero = $_POST['numero'] ?? null;

if ($numero) {
    // Tenter de récupérer le moteur en fonction du numéro fourni
    $engin = $enginManager->getEngin($numero);

    if (!$engin) {
        echo "engin non trouvé.";
        exit;
    }
} else {
    echo "Aucun numéro de engin fourni.";
    exit;
}

// Gérer la soumission du formulaire de mise à jour
if (isset($_POST['update'])) {
    // Récupérer les données du formulaire
    $numero = $_POST['numero'];
    $caserneId = $_POST['caserne'];
    $typeEnginId = $_POST['type_engin'];
    $stock = $_POST['stock'];
    // Gérer le fichier téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $tmpPath = $_FILES['image']['tmp_name'];
        $newPath = "../imageDesEngins" . $image;

        // Déplacer le fichier dans le dossier de destination
        if (move_uploaded_file($tmpPath, $newPath)) {
            // Mettre à jour l'objet engin avec le chemin de la nouvelle image
            $engin->setImage($newPath);
        } else {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    } else {
        echo "Erreur ou aucun fichier téléchargé.";
        exit;
    }
    // Mettre à jour l'objet engin avec les nouvelles valeurs
    $engin->setNumero($numero);
    $engin->setCaserneId($caserneId);
    $engin->setTypeEnginId($typeEnginId);
    $engin->setStock($stock);
    $engin->setImage($image);
    // Appeler EnginManager pour enregistrer les modifications
    $result = $enginManager->updateEngin($engin);

    if ($result) {
        header("Location: ../CaserneEngin.php"); // Rediriger vers une page spécifique après la mise à jour
        exit;
    } else {
        echo "Erreur lors de la mise à jour de l'engin.";
    }
}

// Requête pour récupérer toutes les casernes
$sqlCaserne = "SELECT id, Nom FROM caserne";
$resultCaserne = $db->query($sqlCaserne);

// Requête pour récupérer tous les types d'engins
$sqlTypeEngin = "SELECT id,libellé type FROM type_engin";
$resultTypeEngin = $db->query($sqlTypeEngin);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier les informations du moteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl h-screen px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Modifier les informations de l'engin🚒</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Utilisez le formulaire ci-dessous pour mettre à jour les informations de l'engin sélectionné dans la
                    base de données.
                </p>
                <a href="../caserneEngin.php"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Caserne des engin🏢
                </a>
            </div>
            <?php if ($engin): ?>
                <div class="lg:col-span-5 lg:flex place-self-center">
                    <form action="editerEngin.php" method="POST" enctype="multipart/form-data"
                        class="max-w-md mx-auto p-8 border border-gray-300 rounded-lg bg-white shadow-md">

                        <label for="numero" class="block text-gray-700 font-semibold mb-2">Numéro de l'engin:</label>
                        <input type="text" id="numero" name="numero"
                            value="<?php echo htmlspecialchars($engin->getNumero()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />

                        <label for="caserne" class="block text-gray-700 font-semibold mb-2">Caserne:</label>
                        <select id="caserne" name="caserne"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="" disabled selected>Sélectionnez une caserne</option>
                            <?php while ($caserne = $resultCaserne->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= htmlspecialchars($caserne['id']) ?>"><?= htmlspecialchars($caserne['Nom']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                        <label for="type_engin" class="block text-gray-700 font-semibold mb-2">Type d'engin:</label>
                        <select id="type_engin" name="type_engin"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="" disabled selected>Sélectionnez un type d'engin</option>
                            <?php while ($typeEngin = $resultTypeEngin->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= htmlspecialchars($typeEngin['id']) ?>">
                                    <?= htmlspecialchars($typeEngin['type']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                        <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock :</label>
                        <input type="text" id="stock" name="stock"
                            value="<?php echo htmlspecialchars($engin->getStock()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />

                        <label for="image" class="block text-gray-700 font-semibold mb-2">Chemin de l'image :</label>
                        <input type="file" id="image" name="image"
                            value="<?php echo htmlspecialchars($engin->getImage()); ?>"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                            required />

                        <button type="submit" name="update"
                            class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-300">Mettre
                            à jour</button>
                    </form>
                </div>
            <?php else: ?>
                <p>Aucun moteur trouvé pour ce numéro.</p>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>