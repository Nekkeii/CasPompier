<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Inscrit toi parmi les pompiers 🏴‍☠️🚒👩‍🚒👨‍🚒👩🏿‍🚒</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>


    <?php
    require 'connection.inc.php';
    // Requête SQL pour récupérer les données de la table "grade"
    $sql = "SELECT id, libellé FROM grade";
    $stmt = $db->query($sql);
    $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT id, Nom FROM caserne";
    $stmt = $db->query($sql);
    $caserne = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Inclure la classe Pompier et PompierManager
    require_once '../classes/Pompier.class.php';
    require_once '../classes/PompierManager.php';

    // Créer une instance de PompierManager avec les informations de connexion à la base de données
    $pompierManager = new PompierManager($db);

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Récupérer les valeurs saisies dans le formulaire et créer un objet Pompier
        $pompier = new Pompier(
            $_POST["matricule"],
            $_POST["nom"],
            $_POST["prenom"],
            $_POST["date_naissance"],
            $_POST["telephone"],
            $_POST["sexe"],
            $_POST["grade"],
            $_POST["caserne"]
        );

        // Enregistrer le pompier dans la base de données
        $pompierManager->ajouterpompier($pompier);

    }
    ?>



    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl h-screen px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Ajoute ton pompier 🧑‍🚒</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Si vous souhaitez ajouter un nouveau pompier dans la base de Données, veuillez remplir le formulaire
                    ci-contre avec les informations nécessaires.
                </p>
                <a href="../index.php"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Retour a l'aceuille
                </a>

            </div>
            <div class="lg:col-span-5 lg:flex place-self-center">
                <form id="form" class="max-w-md mx-auto p-8 border border-gray-300 rounded-lg bg-white shadow-md"
                    method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="matricule" class="block text-gray-700 font-semibold mb-2">Matricule</label>
                            <input type="text" id="matricule" name="matricule"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez votre matricule" required />
                        </div>

                        <div>
                            <label for="date_naissance" class="block text-gray-700 font-semibold mb-2">Date de
                                naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                required />
                        </div>

                        <div>
                            <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
                            <input type="text" id="nom" name="nom"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez votre nom" required />
                        </div>

                        <div>
                            <label for="prenom" class="block text-gray-700 font-semibold mb-2">Prénom</label>
                            <input type="text" id="prenom" name="prenom"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez votre prénom" required />
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Sexe</label>
                            <div class="flex">
                                <label class="mr-4">
                                    <input type="radio" name="sexe" value="M" class="mr-2" required>
                                    Masculin
                                </label>
                                <label>
                                    <input type="radio" name="sexe" value="F" class="mr-2" required>
                                    Féminin
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="grade" class="block text-gray-700 font-semibold mb-2">Grade</label>
                            <select id="grade" name="grade"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                required>
                                <option value="" disabled selected>Sélectionnez un grade</option>
                                <?php foreach ($grades as $row): ?>
                                    <option value="<?= htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($row["libellé"], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="telephone" class="block text-gray-700 font-semibold mb-2">Téléphone</label>
                            <input type="text" id="telephone" name="telephone"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez votre numéro de téléphone" required />
                        </div>

                        <div>
                            <label for="caserne" class="block text-gray-700 font-semibold mb-2">Caserne</label>
                            <select id="caserne" name="caserne"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                required>
                                <option value="" disabled selected>Sélectionnez une caserne</option>
                                <?php foreach ($caserne as $row): ?>
                                    <option value="<?= htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($row["Nom"], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" name="submit"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-300">Ajouter</button>
                </form>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Validation du matricule pour accepter uniquement les chiffres
            document.getElementById('matricule').addEventListener('input', function (e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Validation de la date de naissance pour s'assurer qu'elle n'est pas postérieure à la date actuelle
            document.getElementById('date_naissance').addEventListener('change', function (e) {
                var chosenDate = new Date(this.value);
                var currentDate = new Date();
                currentDate.setHours(0, 0, 0, 0); // Réinitialiser l'heure pour une comparaison correcte

                if (chosenDate > currentDate) {
                    this.style.backgroundColor = 'red';
                    alert('La date de naissance ne peut pas être dans le futur !');
                } else {
                    this.style.backgroundColor = '';
                }
            });

            // Forcer la saisie du nom en majuscules
            document.getElementById('nom').addEventListener('input', function (e) {
                this.value = this.value.toUpperCase();
            });
        });

    </script>






</body>

</html>