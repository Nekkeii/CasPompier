<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cas Pompier</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white dark:bg-gray-900 font-sans leading-normal tracking-normal">

  <?php
  session_start();

  if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Afficher la navbar si l'utilisateur est connecté en tant qu'admin
    include ('include/navbar.php');
  } else {
    // Rediriger l'utilisateur vers la page d'authentification s'il n'est pas connecté en tant qu'admin
    header("Location: authentification.php");
    exit();
  }
  ?>
  <?php
  include ('include/home.php');
  include ('include/footer.php')

    ?>


</body>

</html>