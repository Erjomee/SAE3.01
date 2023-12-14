<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php use App\Naturotheque\Lib\ConnexionUtilisateur;

            echo $pagetitle; ?></title>
        <link rel="stylesheet" href="./../assets/css/style.css">
        <link rel="stylesheet" href="./../assets/css/style<?= $style?>.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <?php
//          session_start();
//          $_SESSION['user'] = "fefe"
//          session_destroy();
        ?>
        <header>
            <!-- Right part (logo) -->
            <div class="logo">
                <img src="./../assets/img/sae_logo.png" height="170px">
            </div>
            <!-- Middle part (item) -->
            <nav>
                <ul class="nav-list">
                    <li class="item">
                        <a href="frontController.php?controller=accueil&action=readAll" <?php if ($style == "Accueil") {echo "class='active'";}?>>
                            Accueil</a>
                    </li>
                    <li class="item"><a href="frontController.php?controller=naturotheque&action=readAll" <?php if ($style == "Naturotheque") {echo "class='active'";}?>>
                            Naturothèque</a>
                    </li>
                    <li class="item"><a href="frontController.php?controller=espece&action=search" <?php if ($style == "Espece") {echo "class='active'";}?>>
                            Espèces</a>
                    </li>

                    <li class="item"><a href="http://127.0.0.1/SAE3.01/decouvrir.php" <?php if (basename($_SERVER['PHP_SELF'])=="decouvrir.php") {echo "class='active'";}?>>Découvrir</a></li>
                </ul>
            </nav>
            <!-- Right part (user action) -->
            <div class="user-action" >
                <?php
                    // Si l'utilisateur est connecté
                    if(ConnexionUtilisateur::estConnecte()) {
                        echo "  
                            <div class='utilisateur' style='display: flex'>
                                <div class='bx bxs-user-circle' id='user-icon'></div>
                            </div>
                            <div class='user-action'>
                                <ul class='user-list'>
                                    <li class='item'><a href='frontController.php?controller=utilisateur&action=profil'>Mon profile</a></li>
                                    <li class='item'><a href='frontController.php?controller=utilisateur&action=mynaturotheque'>Ma nathurothèque</a></li>
                                    <li class='item'><a href='frontController.php?controller=utilisateur&action=deconnection'>Déconnexion</a></li>
                                </ul>
                            </div>";
                        // Compte invité
                    }else{
                        echo '<div class="utilisateur">
                                <div class="bx bxs-user-circle" id="user-icon"></div>
                              </div>
                              
                              <div class="user-action">
                                 <ul class="user-deco-list">
                                    <li class="item-user">
                                     <a href="frontController.php?controller=utilisateur&action=connection" class="login"><i class="ri-user-fill"></i>Login</a>
                                    </li>
                                    <li class="item-user">
                                     <a href="frontController.php?controller=utilisateur&action=register" class="register">Register</a>
                                     </li>
                                </ul>
                              </div>';
                    }
                ?>
                <div class="menu">
                    <div class='bx bx-menu' id="menu-icon"></div>
                </div>
            </div>
        </header>


        <main>
            <?php
            if (isset($message)) {
                echo "<div class='alert alert-$message[0]'> $message[1]  </div>";
            }

            require __DIR__ . "/{$cheminVueBody}";    //Corp de la page
            ?>
        </main>


        <footer>
            <p>
                Site de covoiturage de Jérome
            </p>
        </footer>


        <script src="./../assets/js/script.js"></script>
        <script src="./../assets/js/scriptEspece.js"></script>

    </body>

</html>
