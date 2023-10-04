<?php
//    require_once __DIR__ . '/../src/Controller/ControllerVoiture.php';
    require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
    use App\Naturotheque\Controller\ControllerAccueil;

    // instantiate the loader
    $loader = new App\Naturotheque\Lib\Psr4AutoloaderClass();
    // register the base directories for the namespace prefix
    $loader->addNamespace('App\Naturotheque', __DIR__ . '/../src');
    // register the autoloader
    $loader->register();

    // On recupère l'action passée dans l'URL
    $action = $_GET["action"];
    if ($action == "readAll") {
        ControllerVoiture::$action();
    }elseif ($action == "read") {
        $immat = $_GET["immat"];
        ControllerVoiture::$action($immat);
    }elseif ($action == "create" ) {
        ControllerVoiture::$action();
    }elseif ($action == "created") {
        ControllerVoiture::$action([$_GET['immatriculation'], $_GET['marque'], $_GET['couleur'], $_GET['nbsiege']]);
    }
?>
