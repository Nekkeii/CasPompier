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

require 'connection.inc.php';

try {
    $sql = "SELECT id, Nom FROM caserne";
    $result_caserne = $db->query($sql);

    $sqlTypeEngin = "SELECT id, Libellé FROM type_engin"; // Remplacez 'Libellé' par le nom de colonne exact dans votre base de données
    $resultTypeEngin = $db->query($sqlTypeEngin);
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    exit;
}
?>

<?php
require 'connection.inc.php'; // Votre script de connexion PDO
require '../classes/EnginManager.php';
require_once '../classes/Engin.class.php';

if (isset($_POST['submit']) && isset($_FILES['image'])) {
    // Récupérez les données du formulaire
    $caserne = $_POST['caserne'];
    $type_engin_id = $_POST['type_engin_id'];
    $numero = $_POST['numero'];
    $stock = $_POST['stock'];

    // Traiter le téléchargement de l'image
    $image = '../imageDesEngins/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    // Créer un objet Engin
    $engin = new Engin($numero, $caserne, $type_engin_id, $stock, $image);

    // Utiliser EnginManager pour ajouter l'engin à la base de données
    $enginManager = new EnginManager($db);
    $enginManager->add($engin);

    // Redirection vers CaserneEngin.php
    header('Location:../inscriptionEnginOK.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrir un engin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl h-screen px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Ajouter un engin à la caserne 🚒</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Pour intégrer un nouveau véhicule au parc de la caserne, merci de saisir les détails requis dans le
                    formulaire suivant.
                </p>
                <a href="../index.php"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Retour à l'accueil
                </a>
            </div>

            <div class="lg:col-span-5 lg:flex place-self-center">
                <form id="form" class="max-w-md mx-auto p-8 border border-gray-300 rounded-lg bg-white shadow-md"
                    method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 gap-6 mb-6">

                        <!-- Sélection de la caserne -->
                        <div>
                            <label for="caserne" class="block text-gray-700 font-semibold mb-2">Caserne</label>
                            <select id="caserne" name="caserne"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                required>
                                <option value="" disabled selected>Sélectionnez une caserne</option>
                                <?php
                                // Générer dynamiquement les options du select "caserne"
                                while ($row = $result_caserne->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row["id"] . '">' . htmlspecialchars($row["Nom"], ENT_QUOTES, 'UTF-8') . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Sélection du type d'engin -->
                        <div>
                            <label for="type_engin" class="block text-gray-700 font-semibold mb-2">Type d'engin</label>
                            <select id="type_engin" name="type_engin_id"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                required>
                                <option value="" disabled selected>Sélectionnez un type d'engin</option>
                                <!-- Options de type d'engin générées dynamiquement -->

                                <?php
                                // Générer dynamiquement les options du select "type_engin"
                                while ($row = $resultTypeEngin->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row["id"] . '">' . htmlspecialchars($row["Libellé"], ENT_QUOTES, 'UTF-8') . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Numéro de l'engin -->
                        <div>
                            <label for="numero" class="block text-gray-700 font-semibold mb-2">Numéro de l'engin</label>
                            <input type="text" id="numero" name="numero"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez le numéro de l'engin" required />
                        </div>

                        <!-- Stock de l'engin -->
                        <div>
                            <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock</label>
                            <input type="number" id="stock" name="stock"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez la quantité en stock" required />
                        </div>

                        <!-- Image de l'engin -->
                        <div>
                            <label for="image" class="block text-gray-700 font-semibold mb-2">Image de l'engin</label>
                            <input type="file" id="image" name="image"
                                class="w-full px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" name="submit"
                            class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-300">Ajouter
                            l'engin</button>
                    </div>
                </form>


            </div>
        </div>
    </section>









</body>

</html>