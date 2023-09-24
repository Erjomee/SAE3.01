<?php 
    session_start() ;
    session_destroy()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizontal Navigation Bar</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <p><a href="http://localhost/SAE3.01">Logo</a></p>
        </div>

        <nav>
            <ul class="nav-list">
                <!-- Right part (logo) -->
                <!-- Middle part (item) -->
                <li class="item">
                    <a href="http://localhost/SAE3.01" <?php if (basename($_SERVER['PHP_SELF'])=="index.php") {echo "class='active'";}?>>
                    Home</a> 
                </li>
                <li class="item"><a href="http://localhost/SAE3.01" <?php if (basename($_SERVER['PHP_SELF'])=="nathurotheque.php") {echo "class='active'";}?>>
                    Naturothèque</a>
                </li>
                <li class="item"><a href="http://localhost/SAE3.01" <?php if (basename($_SERVER['PHP_SELF'])=="espece.php") {echo "class='active'";}?>>
                    Espèces</a>
                </li>
                <li class="item"><a href="http://localhost/SAE3.01" <?php if (basename($_SERVER['PHP_SELF'])=="map.php") {echo "class='active'";}?>>
                    Map</a>
                </li>
                <li class="item"><a href="http://localhost/SAE3.01">Découvrir</a></li>
                <!-- Right part (user action) -->

            </ul>
        </nav>

        <?php 
                    // Si l'utilisateur est connecté
                    if (!empty($_SESSION['user'])) {
                        echo "";

                    // Compte invité
                    }else{
                        echo '<div>
                                <a href="http://localhost/SAE3.01/authentification/formulaire_connexion.php"><button class="login"><i class="ri-user-fill"></i>Login</button></a>
                                <a href="http://localhost/SAE3.01/authentification/formulaire_inscription.php"><button class="register">Register</button></a>
                                <div class="bx bx-menu" id="menu-icon><div>
                              </div>';
                        echo basename($_SERVER['PHP_SELF']);
                    }
                ?>
    </header>

</body>
</html>



