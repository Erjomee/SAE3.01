<?php
////    require_once __DIR__ . '/../src/Controller/ControllerVoiture.php';
//    require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
//    use App\Naturotheque\Controller\ControllerAccueil;
//
//    // instantiate the loader
//    $loader = new App\Naturotheque\Lib\Psr4AutoloaderClass();
//    // register the base directories for the namespace prefix
//    $loader->addNamespace('App\Naturotheque', __DIR__ . '/../src');
//    // register the autoloader
//    $loader->register();
//
//    // On recupère l'action passée dans l'URL
//    $action = $_GET["action"];
//    if ($action == "readAll") {
//        ControllerVoiture::$action();
//    }elseif ($action == "read") {
//        $immat = $_GET["immat"];
//        ControllerVoiture::$action($immat);
//    }elseif ($action == "create" ) {
//        ControllerVoiture::$action();
//    }elseif ($action == "created") {
//        ControllerVoiture::$action([$_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsiege']]);
//    }
//?>



<?php
    require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
    require_once __DIR__ . '/../src/Controller/ControllerAccueil.php';

    use App\Naturotheque\Controller\ControllerAccueil;
    use App\Naturotheque\Controller\ControllerUtilisateur;
    use App\Naturotheque\Controller\ControllerEspece;


    // instantiate the loader
    $loader = new App\Naturotheque\Lib\Psr4AutoloaderClass();
    // register the base directories for the namespace prefix
    $loader->addNamespace('App\Naturotheque', __DIR__ . '/../src');
    // register the autoloader
    $loader->register();

    if (isset($_GET["controller"])){
        $controller = $_GET["controller"];
    }else{
        $controller = "accueil";
    }

    $controllerClassName = "App\Covoiturage\Controller\Controller" .ucfirst($controller);

    // Cas ou l'URL présent une action
    if(isset($_GET["action"])){
        $action = $_GET["action"];
        if (in_array($action ,get_class_methods('App\Covoiturage\Controller\ControllerVoiture'))) {
            // Action ReadALL ou Create
            if ($action == "readAll" || $action == "create") {
                $controllerClassName::$action();
            }
            // Action Read ou Delete ou Update
            elseif ($action == "read" || $action == "delete" || $action == "update") {
                $immat = $_GET["immat"];
                $controllerClassName::$action($immat);
            }
            // Action Created ou Updated
            elseif ($action == "created" || $action = "updated") {
                if ($controller == "voiture"){
                    $controllerClassName::$action([$_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsiege']]);
                }elseif ($controller == "utilisateur"){
                    $controllerClassName::$action([$_GET['login'],$_GET['nom'],$_GET['prenom']]);
                }
            }

        }else{
            ControllerAccueil::error("Action inconnue");
        }
    }else{ // action readAll par défault
        ControllerAccueil::readAll();
    }
?>
