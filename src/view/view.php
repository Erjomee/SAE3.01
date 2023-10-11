<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" href="./../assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>
    <body>
<!--        --><?php
//        session_start();
//        // session_destroy();
//        ?>
        <header>
            <!-- Right part (logo) -->
            <div class="logo">
                <p><a href="http://127.0.0.1/SAE3.01">Logo</a></p>
            </div>
            <!-- Middle part (item) -->
            <nav>
                <ul class="nav-list">
                    <li class="item">
                        <a href="frontController.php?controller=accueil&action=readAll" <?php if (strpos($pagetitle , "accueil")) {echo "class='active'";}?>>
                            Home</a>
                    </li>
                    <li class="item"><a href="frontController.php?controller=naturotheque&action=readAll " <?php if (basename($_SERVER['PHP_SELF'])=="nathurotheque.php") {echo "class='active'";}?>>
                            Naturothèque</a>
                    </li>
                    <li class="item"><a href="frontController.php?controller=espece&action=search" <?php if (strpos($pagetitle , "espece")) {echo "class='active'";}?>>
                            Espèces</a>
                    </li>

                    <li class="item"><a href="http://127.0.0.1/SAE3.01/decouvrir.php" <?php if (basename($_SERVER['PHP_SELF'])=="decouvrir.php") {echo "class='active'";}?>>Découvrir</a></li>
                </ul>
            </nav>
            <!-- Right part (user action) -->
            <div class="main" >
                <?php
                    // Si l'utilisateur est connecté
                    if (!empty($_SESSION['user'])) {
                        echo "  
                            <div class='utilisateur'>
                                <div class='bx bxs-user-circle' id='user-icon'></div>
                            </div>
                            <div class='user-action'>
                                <ul class='user-list'>
                                    <li class='item'><a href='http://127.0.0.1/SAE3.01/decouvrir.php'>Mon profile</a></li>
                                    <li class='item'><a href='http://127.0.0.1/SAE3.01/decouvrir.php'>Ma nathurothèque</a></li>
                                    <li class='item'><a href='http://127.0.0.1/SAE3.01/decouvrir.php'>Déconnexion</a></li>
                                </ul>
                            </div>
                            <div class='menu'>
                                <div class='bx bx-menu' id='menu-icon'></div>
                            </div>";
                        // Compte invité
                    }else{
                        echo '<a href="frontController.php?controller=utilisateur&action=connection"><button class="login"><i class="ri-user-fill"></i>Login</button></a>
                        <a href="frontController.php?controller=utilisateur&action=register"><button class="register">Register</button></a>
                        <div class="bx bx-menu" id="menu-icon"><div>';
                    }
                ?>
            </div>
        </header>


        <main>
            <?php
            require __DIR__ . "/{$cheminVueBody}";    //Corp de la page
            ?>
        </main>


        <footer>
            <p>
                Site de covoiturage de Jérome
            </p>
        </footer>


        <script src="./../assets/js/script.js"></script>
    </body>

</html>
