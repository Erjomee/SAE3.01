<?php
    namespace App\Naturotheque\Controller ;
    use App\Naturotheque\Lib\Psr4AutoloaderClass;

    require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

    // On récupère tous les controllers
    require_once __DIR__ . '/../src/Controller/ControllerAccueil.php';
    require_once __DIR__ . '/../src/Controller/ControllerEspece.php';
    require_once __DIR__ . '/../src/Controller/ControllerEspece.php';


    use App\Naturotheque\Controller\ControllerAccueil;
    use App\Naturotheque\Controller\ControllerUtilisateur;
    use App\Naturotheque\Controller\ControllerEspece;




    // instantiate the loader
    $loader = new Psr4AutoloaderClass();
    // register the base directories for the namespace prefix
    $loader->addNamespace('App\Naturotheque', __DIR__ . '/../src');
    // register the autoloader
    $loader->register();

    if (isset($_GET["controller"])){
        $controller = $_GET["controller"];
    }else{
        $controller = "accueil";
    }

    $controllerClassName = "App\Naturotheque\Controller\Controller" .ucfirst($controller);

    // Cas ou l'URL présent une action
    if(isset($_GET["action"])){
        $action = $_GET["action"];
        // Action ReadALL
        if ($action == "readAll" || $action = "search") {
            $controllerClassName::$action();
        }

        // Action Created ou Updated
        elseif ( $action == "created" || $action = "updated") {
            if ($controller == "voiture"){
                $controllerClassName::$action([$_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsiege']]);
            }elseif ($controller == "utilisateur"){
                $controllerClassName::$action([$_GET['login'],$_GET['nom'],$_GET['prenom']]);
            }
        }else{
            ControllerAccueil::error("Action inconnue");
        }
    }else{ // action readAll par défault
        ControllerAccueil::readAll();
    }
?>
