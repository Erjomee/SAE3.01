<?php 
    session_start();
    // session_destroy();
?>
<header>
            <!-- Right part (logo) -->
    <div class="logo">
        <p><a href="http://127.0.0.1/SAE3.01">Logo</a></p>
    </div>
            <!-- Middle part (item) -->
    <nav>    
        <ul class="nav-list">
            <li class="item">
                <a href="http://127.0.0.1/SAE3.01" <?php if (basename($_SERVER['PHP_SELF'])=="index.php") {echo "class='active'";}?>>
                Home</a> 
            </li>
            <li class="item"><a href="http://127.0.0.1/SAE3.01/nathurotheque.php" <?php if (basename($_SERVER['PHP_SELF'])=="nathurotheque.php") {echo "class='active'";}?>>
                Naturothèque</a>
            </li>
            <li class="item"><a href="http://127.0.0.1/SAE3.01/espece.php" <?php if (basename($_SERVER['PHP_SELF'])=="espece.php") {echo "class='active'";}?>>
                Espèces</a>
            </li>
            <li class="item"><a href="http://127.0.0.1/SAE3.01/map.php" <?php if (basename($_SERVER['PHP_SELF'])=="map.php") {echo "class='active'";}?>>
                Map</a>
            </li>
            <li class="item"><a href="http://127.0.0.1/SAE3.01/decouvrir.php" <?php if (basename($_SERVER['PHP_SELF'])=="decouvrir.php") {echo "class='active'";}?>>Découvrir</a></li>
        </ul>
    </nav>
            <!-- Right part (user action) -->
    <div class="main" >
        <?php 
            // Si l'utilisateur est connecté
            if (!empty($_SESSION['user'])) {
                echo "  <div class='utilisateur'>
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
                            <div class='bx bx-menu' id='menu-icon'><div>
                        </div>
                        ";
            // Compte invité
            }else{
                echo '<a href="http://127.0.0.1/SAE3.01/authentification/formulaire_connexion.php"><button class="login"><i class="ri-user-fill"></i>Login</button></a>
                        <a href="http://127.0.0.1/SAE3.01/authentification/formulaire_inscription.php"><button class="register">Register</button></a>
                        <div class="bx bx-menu" id="menu-icon"><div>';
            }
        ?>
    </div>
</header>




