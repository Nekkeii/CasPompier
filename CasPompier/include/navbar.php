<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>

<body class="">

  <?php


  // Vérification si l'utilisateur est connecté en tant qu'admin
  if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Afficher la navbar si l'utilisateur est connecté en tant qu'admin
    ?>
    <nav class="bg-gray-800 py-4 px-6">
      <div class="flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
          <a href="./index.php" class="text-white font-bold text-xl">Cas pompier 🚒</a>
        </div>

        <!-- Navigation Links -->
        <div class="flex space-x-8">
          <a href="./Caserne.php" class="text-white hover:text-gray-300 transition-colors duration-300">Caserne 🏢</a>
          <a href="./include/inscription.inc.php"
            class="text-white hover:text-gray-300 transition-colors duration-300">Inscrire un pompier 👨‍🚒</a>
          <a href="./CaserneEngin.php" class="text-white hover:text-gray-300 transition-colors duration-300">Voir les
            engins 🚗</a>
          <a href="./include/inscrireEngin.php"
            class="text-white hover:text-gray-300 transition-colors duration-300">Incrire un engin 🚗</a>
          <a href="./pagehistorique.php" class="text-white hover:text-gray-300 transition-colors duration-300">Voir
            l'historique ⏲️</a>
          <a href="./deconnection.php" class="text-white hover:text-gray-300 transition-colors duration-300">Se
            déconnecter</a>
        </div>
      </div>
    </nav>

    <?php
  } else {
    // Afficher le lien "Se connecter" si l'utilisateur n'est pas connecté en tant qu'admin
    ?>
    <div class="bg-gray-800 py-4 px-6">
      <div class="flex justify-end items-center">
        <a href="./authentification.php" class="text-white hover:text-gray-300 transition-colors duration-300">Se
          connecter</a>
      </div>
    </div>
    <?php
  }
  ?>

</body>