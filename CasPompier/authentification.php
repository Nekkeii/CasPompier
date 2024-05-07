<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des identifiants (à remplacer par votre logique d'authentification)
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    if ($identifiant === 'admin' && $mot_de_passe === 'azerty11') {
        // Authentification réussie, définir la session 'admin' et rediriger vers la page souhaitée
        $_SESSION['admin'] = true;
        header("Location: index.php");
        exit();
    } else {
        // Identifiant ou mot de passe incorrect, afficher un message d'erreur
        $error_message = "Identifiant ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <section class="bg-white dark:bg-gray-900">  
        <div class="grid max-w-screen-xl h-screen px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Connectez-vous avant de continuer ! 🚒</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Veuillez entrer votre identifiant et votre mot de passe pour accéder.</p>
                <a href="../index.php"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Retour à l'accueil
                </a>
            </div>

            <div class="lg:col-span-5 lg:flex place-self-center">
                <form id="form" class="max-w-md mx-auto p-8 border border-gray-300 rounded-lg bg-white shadow-md"
                    method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 gap-6 mb-6">

                        <!-- Identifiant -->
                        <div>
                            <label for="identifiant" class="block text-gray-700 font-semibold mb-2">Identifiant</label>
                            <input type="text" id="identifiant" name="identifiant"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez votre identifiant" required />
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="mot_de_passe" class="block text-gray-700 font-semibold mb-2">Mot de
                                passe</label>
                            <input type="password" id="mot_de_passe" name="mot_de_passe"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                                placeholder="Entrez votre mot de passe" required />
                        </div>

                        <?php
                        // Affichage du message d'erreur s'il existe
                        if (isset($error_message)) {
                            echo '<p class="text-red-500">' . $error_message . '</p>';
                        }
                        ?>

                        <!-- Bouton de connexion -->
                        <button type="submit" name="submit"
                            class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-300">Se
                            connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>