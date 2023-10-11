<?php
//    require_once __DIR__ . '/../src/Controller/ControllerVoiture.php';
require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
use App\Naturotheque\Controller\ControllerEspece;
use App\Naturotheque\Controller\ControllerUtilisateur;
use App\Naturotheque\Controller\ControllerAccueil;

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

$controllerClassName = "App\Naturotheque\Controller\Controller" .ucfirst($controller);

// Cas ou l'URL présent une action
if(isset($_GET["action"])){
    $action = $_GET["action"];
    // Action qui redirige vers les pages assignées
    if ($action == "readAll" || $action == "search" || $action == "connection" || $action == "register") {
        $controllerClassName::$action();
    }

    elseif ( $action == "connected") {
        $controllerClassName::$action();
    }

    // Action qui enregistre le nouveau utilisateur dans la BD
    elseif ($action == "registered"){
        $data = [
            "nom" => $_GET["nom"],
            "prenom" => $_GET["prenom"],
            "email" => $_GET["email"],
            "password" => $_GET["password"]
        ];

        // Vérifiez si les clés "numero" et "sexe" existent dans $_GET
        if (isset($_GET["numero"])) {
            $data["numero"] = $_GET["numero"];
        }else{
            $data["numero"] = "Non spécifié";
        }

        if (isset($_GET["sexe"])) {
            $data["sexe"] = $_GET["sexe"];
        }else{
            $data["sexe"] = "Non spécifié";
        }

        $controllerClassName::$action($data);
    }

    // Action inconnue
    else{
        ControllerAccueil::error("Action inconnue");
    }
}else{ // action readAll par défault
    ControllerAccueil::readAll();
}
?>
