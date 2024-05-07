
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
// Inclure les fichiers nécessaires
include_once 'include/connection.inc.php'; 
include_once 'classes/PompierManager.php'; 


// Récupération de l'historique des pompiers supprimés caserne par caserne

// Caserne 1
$query_supprimes_caserne1 = "SELECT 
                                Matricule, 
                                Nom, 
                                Prenom, 
                                DateNaiss, 
                                Tel, 
                                Sexe, 
                                grade_id, 
                                caserne, 
                                dateSuppression
                            FROM pompierSupprime
                            WHERE caserne = 1";
$statement_supprimes_caserne1 = $db->prepare($query_supprimes_caserne1);
$statement_supprimes_caserne1->execute();
$pompiers_supprimes_caserne1 = $statement_supprimes_caserne1->fetchAll(PDO::FETCH_ASSOC);

// Caserne 2
$query_supprimes_caserne2 = "SELECT 
                                Matricule, 
                                Nom, 
                                Prenom, 
                                DateNaiss, 
                                Tel, 
                                Sexe, 
                                grade_id, 
                                caserne, 
                                dateSuppression
                            FROM pompierSupprime
                            WHERE caserne = 2";
$statement_supprimes_caserne2 = $db->prepare($query_supprimes_caserne2);
$statement_supprimes_caserne2->execute();
$pompiers_supprimes_caserne2 = $statement_supprimes_caserne2->fetchAll(PDO::FETCH_ASSOC);

// Caserne 3
$query_supprimes_caserne3 = "SELECT 
                                Matricule, 
                                Nom, 
                                Prenom, 
                                DateNaiss, 
                                Tel, 
                                Sexe, 
                                grade_id, 
                                caserne, 
                                dateSuppression
                            FROM pompierSupprime
                            WHERE caserne = 3";
$statement_supprimes_caserne3 = $db->prepare($query_supprimes_caserne3);
$statement_supprimes_caserne3->execute();
$pompiers_supprimes_caserne3 = $statement_supprimes_caserne3->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Affichage de la page historique.php -->

<body class="bg-white dark:bg-gray-900 font-sans leading-normal tracking-normal">
<?php

include ('include/navbar.php');

?>

    <section class="Surpressions">
        <div class="container mx-auto py-12">
            <h1
                class="text-4xl md:text-5xl xl:text-6xl font-extrabold tracking-tight leading-none mb-12 text-gray-800 dark:text-white">
                Historique des Surpressions 🔥</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                Ici, vous pouvez consulter l'historique des surpressions de votre CRUD : les restaurations, les
                modifications, et les suppressions effectuées sur vos données.
            </p>

            <div class="space-y-8">
                <!-- Section pour les surpressions de Carcassonne -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">Surpressions de Carcassonne
                        🏰</h2>
                    <table class="w-full">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3">Matricule</th>
                                <th class="px-6 py-3">Nom</th>
                                <th class="px-6 py-3">Prénom</th>
                                <th class="px-6 py-3">Date de naissance</th>
                                <th class="px-6 py-3">Téléphone</th>
                                <th class="px-6 py-3">Sexe</th>
                                <th class="px-6 py-3">Grade</th>
                                <th class="px-6 py-3">Date de suppression</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600">
                            <?php foreach ($pompiers_supprimes_caserne1 as $surpression) { ?>
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Matricule']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Nom']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Prenom']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['DateNaiss']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Tel']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Sexe']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['grade_id']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['dateSuppression']; ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="./CRUD/restaurerPompier.php" method="POST">
                                            <input type="hidden" name="matricule" value="<?= $surpression['Matricule']; ?>">
                                            <button type="submit"
                                                class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                                Restaurer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Surpressions d'Ouessant -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                        Surpressions d'Ouessant 🌊</h2>
                    <table class="w-full">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3">Matricule</th>
                                <th class="px-6 py-3">Nom</th>
                                <th class="px-6 py-3">Prénom</th>
                                <th class="px-6 py-3">Date de naissance</th>
                                <th class="px-6 py-3">Téléphone</th>
                                <th class="px-6 py-3">Sexe</th>
                                <th class="px-6 py-3">Grade</th>
                                <th class="px-6 py-3">Date de suppression</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600">
                            <?php foreach ($pompiers_supprimes_caserne2 as $surpression) { ?>
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Matricule']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Nom']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Prenom']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['DateNaiss']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Tel']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Sexe']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['grade_id']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['dateSuppression']; ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="./CRUD/restaurerPompier.php" method="POST">
                                            <input type="hidden" name="matricule" value="<?= $surpression['Matricule']; ?>">
                                            <button type="submit"
                                                class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                                Restaurer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Surpressions de Lille -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                        Surpressions de Lille 🏙️</h2>
                    <table class="w-full">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3">Matricule</th>
                                <th class="px-6 py-3">Nom</th>
                                <th class="px-6 py-3">Prénom</th>
                                <th class="px-6 py-3">Date de naissance</th>
                                <th class="px-6 py-3">Téléphone</th>
                                <th class="px-6 py-3">Sexe</th>
                                <th class="px-6 py-3">Grade</th>
                                <th class="px-6 py-3">Date de suppression</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600">
                            <?php foreach ($pompiers_supprimes_caserne3 as $surpression) { ?>
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Matricule']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Nom']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Prenom']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['DateNaiss']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Tel']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['Sexe']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['grade_id']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $surpression['dateSuppression']; ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="./CRUD/restaurerPompier.php" method="POST">
                                            <input type="hidden" name="matricule" value="<?= $surpression['Matricule']; ?>">
                                            <button type="submit"
                                                class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                                Restaurer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
    </section>


</body>