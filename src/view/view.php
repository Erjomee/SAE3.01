<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php use App\Naturotheque\Lib\ConnexionUtilisateur;

            echo $pagetitle; ?></title>
        <link rel="stylesheet" href="./../assets/css/style.css">
        <link rel="stylesheet" href="./../assets/css/rSlider.min.css">
        <link rel="stylesheet" href="./../assets/css/style<?php if (isset($style_double)) {echo $style_double;}?>.css">
        <link rel="stylesheet" href="./../assets/css/style<?= $style?>.css">
        <link rel="icon" href="./../assets/img/sae_logo.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" >
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- lien footer PROVISOIRE-->
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-brands/css/uicons-brands.css'>
       
    </head>
    <body>
        <?php
//          session_start();
//          $_SESSION['user'] = "fefe"
//          session_destroy();
        ?>
        <header>
            <!-- Right part (logo) -->
            <a href="frontController.php?controller=accueil&action=readAll">
                <div class="logo">
                    <img src="./../assets/img/sae_logo.png" height="170px">
                </div>
            </a>

            <!-- Middle part (item) -->
            <nav>
                <ul class="nav-list">
                    <li class="item">
                        <a href="frontController.php?controller=accueil&action=readAll" <?php if ($style == "Accueil") {echo "class='active'";}?>>
                            Accueil</a>
                    </li>
                    <li class="item"><a href="frontController.php?controller=naturotheque&action=readAll" <?php if ($style == "Naturotheque" || $style == "MaNaturotheque" || $style == "VisiteNaturotheque") {echo "class='active'";}?>>
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
                            ";
                        if ($utilisateur->get("photo_profil") !== null) {
                            echo "<div class='avatar_nav' style='background-image: url(\"./../assets/img/img_profil/{$utilisateur->get("photo_profil")}\");'></div>";
                        }else {
                            echo "<div class='bx bxs-user-circle' id='user-icon'></div>";
                        }
                        echo "  <div class='user-action'>
                                    <ul class='user-list'>
                                        <div class='avatar_nav' style='background-image: url(\"./../assets/img/img_profil/{$utilisateur->get("photo_profil")}\");'><a style='width:80px ; height: 80px'    href='frontController.php?controller=utilisateur&action=profil'></a></div>
                                        <h2>{$utilisateur->get("nom")} {$utilisateur->get("prenom")}</h2>
                                        <p>   {$utilisateur->get("email")} </p>
                                        <li class='item'><a href='frontController.php?controller=utilisateur&action=profil'><i class='bx bx-user'></i>Profile</a></li>
                                        <li class='item'><a href='frontController.php?controller=naturotheque&action=afficher_naturotheque&email={$utilisateur->get("email")}'><i class='bx bx-collection'></i>Collection</a></li>  
                                        <hr>                                        
                                        <li class='item'><a href='frontController.php?controller=utilisateur&action=deconnection'><i class='bx bx-log-out'></i>Déconnexion</a></li>
                                    </ul>
                                </div>
                                
                            </div>

                        ";
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

        <!-- <div id='google_translate_element'></div> -->


        <footer  <?php if ($pagetitle == "Formulaire de connexion" || $pagetitle ==  "Formulaire d'inscription") {
            echo "style='display: none;'";
        }?> >
        <!-- <div id ="first"> -->
            <div id ="logofooter">
                <img src="./../assets/img/sae_logo.png" height="170">
                <div id ="separation">
                </div>
                <a href = "https://www.u-pec.fr"> 
                    <img src ="./../assets/img/UPEC_footer.png" height="110">
                </a>
            </div>
                
       
        <div id = "siteMap">
            <h3> SITE MAP</h3>
            <a href = "http://localhost/SAE3.01/web/frontController.php?controller=accueil&action=readAll">Accueil</a>
            <a href = "http://localhost/SAE3.01/web/frontController.php?controller=naturotheque&action=readAll">Naturothèque</a>
            <a href ="http://localhost/SAE3.01/web/frontController.php?controller=espece&action=search">Espèces</a>
            <a href = "http://127.0.0.1/SAE3.01/decouvrir.php">Découvrir</a>
        </div>

        
            
            <div id = "content">
            <div id = "icones">
                <a href="https://www.facebook.com/InventaireNationalPatrimoineNaturel/" class = "icone">
                    <i class="fi fi-brands-facebook"></i>
                </a>
                <a href="https://www.youtube.com/channel/UCnWtd37WTOyPdPO8_DEYicw" class="icone">
                    <i class="fi fi-brands-youtube"></i>
                </a>
                <a href="https://twitter.com/INPN_MNHN" class="icone">
                    <i class="fi fi-brands-twitter-alt"></i>
                </a>

            </div>

            <div id='google_translate_element' ></div>
        </div> 


       
             <!-- <div id = "licence">
            <p>Copyright ©2024 TaxonSphère</p> 
            </div> -->
        </footer>

<!-- 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.1.1/chartjs-plugin-zoom.min.js"></script> -->
        <!-- <script src="./../assets/js/script.js"></script> -->
        <!-- <script src="./../assets/js/rSlider.min.js"></script> -->
        <!-- <script src="./../assets/js/scriptEspece.js"></script> -->
        <!-- <script src="./../assets/js/scriptProfil.js"></script> -->

        <?php 

        if (!isset($script)) {
            $script ="";
        }
        
        if ($script == "Espece") {
            echo ' <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.1.1/chartjs-plugin-zoom.min.js"></script>';
            echo '<script src="./../assets/js/script.js"></script>';

            echo '<script src="./../assets/js/rSlider.min.js"></script>';
            echo '<script src="./../assets/js/scriptEspece.js"></script>';
        }elseif ($script == "Naturotheque") {
            echo ' <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.1.1/chartjs-plugin-zoom.min.js"></script>';
            echo '<script src="./../assets/js/rSlider.min.js"></script>';
            echo '<script src="./../assets/js/script.js"></script>';

            echo '<script src="./../assets/js/scriptEspece.js"></script>';
            echo '<script src="./../assets/js/scriptNaturotheque.js"></script>';
        }elseif ($script == "Profile"){
            echo '<script src="./../assets/js/script.js"></script>';
            echo '<script src="./../assets/js/scriptProfil.js"></script>';
        }elseif ($script == "Accueil"){
            echo '<script src="./../assets/js/script.js"></script>';
            echo '<script src="./../assets/js/scriptAccueil.js"></script>';
        }else{
            echo '<script src="./../assets/js/script.js"></script>';

        }
        ?>


<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'fr'
    }
    , 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


    </body>

</html>
