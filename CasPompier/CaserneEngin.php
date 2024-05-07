<?php
session_start();

// Vérification si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Rediriger l'utilisateur vers la page d'authentification
    header("Location: authentification.php");
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Crus Caserne</title>
</head>

<?php
require_once 'include/connection.inc.php'; // Utilisez require_once pour éviter des inclusions multiples
require_once 'classes/EnginManager.php'; // Assurez-vous que le chemin est correct
$enginManager = new EnginManager($db);
$enginsData = $enginManager->getList();

$engins = [];
foreach ($enginsData as $enginData) {
    // Supposons que $enginsData est un tableau d'objets de type Engin
    $engins[] = new Engin(
        $enginData->getNumero(),
        $enginData->getCaserneid(),
        $enginData->getTypeEnginId(),
        $enginData->getStock(),
        $enginData->getImage()
    );
}

// Récupère les engins de la caserne de Carcassonne
$caserneIdCarcassonne = 1; // ID de la caserne de Carcassonne (à remplacer par l'ID réel)
$enginsCarcassonne = $enginManager->getListByCaserneId($caserneIdCarcassonne);

// Récupère les engins de la caserne d'Ouessant
$caserneIdOuessant = 2; // ID de la caserne d'Ouessant (à remplacer par l'ID réel)
$enginsOuessant = $enginManager->getListByCaserneId($caserneIdOuessant);

// Récupère les engins de la caserne de Lille
$caserneIdLille = 3; // ID de la caserne de Lille (à remplacer par l'ID réel)
$enginsLille = $enginManager->getListByCaserneId($caserneIdLille);
?>

<body class="bg-white dark:bg-gray-900 font-sans leading-normal tracking-normal">

    <?php
    include ('include/navbar.php');
    ?>

    <section class="Crud">
        <div class="container mx-auto py-12">
            <h1
                class="text-4xl md:text-5xl xl:text-6xl font-extrabold tracking-tight leading-none mb-12 text-gray-800 dark:text-white">
                Gestion des Engins 🚒
            </h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                Ici, vous pouvez gérer tous les aspects des véhicules de la caserne : les modifier et les supprimer
                selon les besoins de votre caserne.
            </p>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                    Engin de la caserne de Carcassonne 🏰
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-5">
                    <?php foreach ($enginsCarcassonne as $engin): ?>
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <img class="rounded-t-lg" src="imageDesEngins/<?= htmlspecialchars($engin->getImage()) ?>"
                                alt="Engin">

                            <div class="p-5">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <?= htmlspecialchars($engin->getTypeEnginId()) ?>
                                </h5>
                                <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                                    Numéro: <?= htmlspecialchars($engin->getNumero()) ?>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Stock: <?= htmlspecialchars($engin->getStock()) ?>
                                </p>

                                <form method="POST" action="./CRUD/supprimerEngin.php"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet engin ?');">
                                    <input type="hidden" name="numero" value="<?= htmlspecialchars($engin->getNumero()) ?>">
                                    <button type="submit" name="delete"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">Supprimer</button>
                                </form>

                                <form method="POST" action="./CRUD/editerEngin.php">
                                    <input type="hidden" name="numero" value="<?= htmlspecialchars($engin->getNumero()) ?>">
                                    <button type="submit" name="edit"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Modifier
                                        <!-- SVG icon for modify button -->
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM16 7l2-2 1 1-2 2-1-1zM5 15H3v2a1 1 0 001 1h2v-2H5v-1zM3 9v2h2V9H3zm0 4h2v-2H3v2zm12 2h2v-2h-2v2zm0 4v-2h-2v2h2zm-4 0h2v-2h-2v2zm-4 0v-2H7v2h2z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </div> 
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="container mx-auto py-12">
            <div class="space-y-8">
                <!-- Section pour les pompiers de Carcassonne -->
                <!-- Section pour les pompiers de Carcassonne -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                        Engin de la caserne d'Ouessant
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-5">
                        <?php foreach ($enginsOuessant as $engin): ?>
                            <div
                                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <img class="rounded-t-lg" src="imageDesEngins/<?= htmlspecialchars($engin->getImage()) ?>"
                                    alt="Engin">

                                <div class="p-5">
                                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        <?= htmlspecialchars($engin->getTypeEnginId()) ?>
                                    </h5>
                                    <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                                        Numéro: <?= htmlspecialchars($engin->getNumero()) ?>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Stock: <?= htmlspecialchars($engin->getStock()) ?>
                                    </p>

                                    <form method="POST" action="./CRUD/supprimerEngin.php"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet engin ?');">
                                        <input type="hidden" name="numero"
                                            value="<?= htmlspecialchars($engin->getNumero()) ?>">
                                        <button type="submit" name="delete"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">Supprimer</button>
                                    </form>

                                    <form method="POST" action="./CRUD/editerEngin.php">
                                        <input type="hidden" name="numero"
                                            value="<?= htmlspecialchars($engin->getNumero()) ?>">
                                        <button type="submit" name="edit"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Modifier
                                            <!-- SVG icon for modify button -->
                                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM16 7l2-2 1 1-2 2-1-1zM5 15H3v2a1 1 0 001 1h2v-2H5v-1zM3 9v2h2V9H3zm0 4h2v-2H3v2zm12 2h2v-2h-2v2zm0 4v-2h-2v2h2zm-4 0h2v-2h-2v2zm-4 0v-2H7v2h2z">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="container mx-auto py-12">
            <div class="space-y-8">
                <!-- Section pour les pompiers de Carcassonne -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                        Engin de la caserne de Lille 🏤
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-5">
                        <?php foreach ($enginsLille as $engin): ?>
                            <div
                                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <img class="rounded-t-lg" src="imageDesEngins/<?= htmlspecialchars($engin->getImage()) ?>"
                                    alt="Engin">

                                <div class="p-5">
                                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        <?= htmlspecialchars($engin->getTypeEnginId()) ?>
                                    </h5>
                                    <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                                        Numéro: <?= htmlspecialchars($engin->getNumero()) ?>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        Stock: <?= htmlspecialchars($engin->getStock()) ?>
                                    </p>

                                    <form method="POST" action="./CRUD/supprimerEngin.php"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet engin ?');">
                                        <input type="hidden" name="numero"
                                            value="<?= htmlspecialchars($engin->getNumero()) ?>">
                                        <button type="submit" name="delete"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">Supprimer</button>
                                    </form>

                                    <form method="POST" action="./CRUD/editerEngin.php">
                                        <input type="hidden" name="numero"
                                            value="<?= htmlspecialchars($engin->getNumero()) ?>">
                                        <button type="submit" name="edit"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Modifier
                                            <!-- SVG icon for modify button -->
                                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM16 7l2-2 1 1-2 2-1-1zM5 15H3v2a1 1 0 001 1h2v-2H5v-1zM3 9v2h2V9H3zm0 4h2v-2H3v2zm12 2h2v-2h-2v2zm0 4v-2h-2v2h2zm-4 0h2v-2h-2v2zm-4 0v-2H7v2h2z">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>

</body>

</html>