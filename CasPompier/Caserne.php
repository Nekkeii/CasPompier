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

<?php include_once 'include/connection.inc.php'; ?>
<?php include_once 'classes/PompierManager.php'; ?>

<?php

$query = "SELECT 
                Matricule, 
                Nom AS NomPompier, 
                Prenom AS PrenomPompier, 
                DateNaiss AS DateNaissPompier, 
                Tel AS TelPompier, 
                Sexe AS SexePompier,
                grade_id AS IdGrade
            FROM pompier 
            WHERE caserne = 1";
// Exécution de la requête SQL
$statement = $db->prepare($query);
$statement->execute();
$pompiers = $statement->fetchAll(PDO::FETCH_ASSOC);



// Récupération des pompiers de Ouessant
$query_ouessant = "SELECT 
                    Matricule, 
                    Nom AS NomPompier, 
                    Prenom AS PrenomPompier, 
                    DateNaiss AS DateNaissPompier, 
                    Tel AS TelPompier, 
                    Sexe AS SexePompier,
                    grade_id AS IdGrade
                FROM pompier 
                WHERE caserne = 2"; // Changer l'ID de la caserne si nécessaire
$statement_ouessant = $db->prepare($query_ouessant);
$statement_ouessant->execute();
$pompiers_ouessant = $statement_ouessant->fetchAll(PDO::FETCH_ASSOC);

// Récupération des pompiers de Lille
$query_lille = "SELECT 
                Matricule, 
                Nom AS NomPompier, 
                Prenom AS PrenomPompier, 
                DateNaiss AS DateNaissPompier, 
                Tel AS TelPompier, 
                Sexe AS SexePompier,
                grade_id AS IdGrade
            FROM pompier 
            WHERE caserne = 3"; // Changer l'ID de la caserne si nécessaire
$statement_lille = $db->prepare($query_lille);
$statement_lille->execute();
$pompiers_lille = $statement_lille->fetchAll(PDO::FETCH_ASSOC);

?>




<body class="bg-white dark:bg-gray-900 font-sans leading-normal tracking-normal">

    <?php

    include ('include/navbar.php');


    ?>



    <section class="Crud">
        <div class="container mx-auto py-12">
            <h1
                class="text-4xl md:text-5xl xl:text-6xl font-extrabold tracking-tight leading-none mb-12 text-gray-800 dark:text-white">
                Gestion des Casernes 🏤</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                Ici, vous pouvez gérer tous les aspects de vos pompiers : les inscrire, les modifier et les supprimer
                selon les besoins de votre caserne.
                <?php
                // Afficher les messages d'erreur de suppression
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'deletionfailed' && isset($_GET['message'])) {
                        echo '<div style="color: red; margin-top: 20px;">Erreur lors de la suppression : ' . htmlspecialchars(urldecode($_GET['message'])) . '</div>';
                    } else if ($_GET['error'] == 'nomatricule') {
                        echo '<div style="color: red; margin-top: 20px;">Erreur : Aucun matricule fourni pour la suppression.</div>';
                    }
                }

                // Message de succès
                if (isset($_GET['success']) && $_GET['success'] == 'deletion') {
                    echo '<div style="color: green; margin-top: 20px;">Pompier supprimé avec succès.</div>';
                }
                ?>
            </p>

            <div class="space-y-8">
                <!-- Section pour les pompiers de Carcassonne -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">

                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                        Pompiers de Carcassonne 🏰</h2>
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
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600">
                            <?php foreach ($pompiers as $pompier) { ?>
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['Matricule']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['NomPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['PrenomPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['DateNaissPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['TelPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['SexePompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['IdGrade']; ?></td>
                                    <td class="px-6 py-4 text-center">

                                        <form action="./CRUD/editerPompier.php" method="POST">
                                            <input type="hidden" name="matricule" value="<?= $pompier['Matricule']; ?>">
                                            <button type="submit"
                                                class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                                Éditer
                                            </button>
                                        </form>


                                        <form action="./CRUD/supprimerPompier.php" method="post">
                                            <input type="hidden" name="matricule"
                                                value="<?php echo $pompier['Matricule']; ?>">
                                            <button type="submit" name="delete"
                                                class="text-white bg-red-600 hover:bg-red-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                                Supprimer
                                            </button>
                                        </form>


                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pompiers d'Ouessant -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                        Pompiers d'Ouessant 🌊</h2>
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
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600">
                            <?php foreach ($pompiers_ouessant as $pompier) { ?>
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['Matricule']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['NomPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['PrenomPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['DateNaissPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['TelPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['SexePompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['IdGrade']; ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="./CRUD/editerPompier.php" method="POST">
                                            <input type="hidden" name="matricule" value="<?= $pompier['Matricule']; ?>">
                                            <button type="submit"
                                                class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                                Éditer
                                            </button>
                                        </form>



                                        <form action="./CRUD/supprimerPompier.php" method="post">
                                            <input type="hidden" name="matricule"
                                                value="<?php echo $pompier['Matricule']; ?>">
                                            <input type="submit" name="delete" value="Supprimer"
                                                class="text-white bg-red-600 hover:bg-red-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                        </form>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pompiers de Lille -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold py-5 px-6 bg-gray-900 text-white">
                        Pompiers de Lille 🏙️</h2>
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
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600">
                            <?php foreach ($pompiers_lille as $pompier) { ?>
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['Matricule']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['NomPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['PrenomPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['DateNaissPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['TelPompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['SexePompier']; ?></td>
                                    <td class="px-6 py-4 text-center"><?php echo $pompier['IdGrade']; ?></td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="./CRUD/editerPompier.php" method="POST">
                                            <input type="hidden" name="matricule" value="<?= $pompier['Matricule']; ?>">
                                            <button type="submit"
                                                class="text-white bg-green-600 hover:bg-green-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                                Éditer
                                            </button>
                                        </form>



                                        <form action="./CRUD/supprimerPompier.php" method="post">
                                            <input type="hidden" name="matricule"
                                                value="<?php echo $pompier['Matricule']; ?>">
                                            <input type="submit" name="delete" value="Supprimer"
                                                class="text-white bg-red-600 hover:bg-red-700 transition duration-300 font-semibold py-2 px-4 rounded-lg">
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</body>


</html>