<?php
//    require_once __DIR__ . '/../src/Controller/ControllerVoiture.php';
require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
use App\Naturotheque\Controller\ControllerEspece;
use App\Naturotheque\Controller\ControllerUtilisateur;
use App\Naturotheque\Controller\ControllerAccueil;
use App\Naturotheque\Controller\ControllerNaturotheque;
use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Lib\MessageFlash;
use App\Naturotheque\Model\Repository\UtilisateurRepository;

// instantiate the loader
$loader = new App\Naturotheque\Lib\Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Naturotheque', __DIR__ . '/../src');
// register the autoloader
$loader->register();


// On construit le chemin vers le bon controller
if (isset($_GET["controller"])){
    $controller = $_GET["controller"];
}else{
    $controller = "accueil";
}
$controllerClassName = "App\Naturotheque\Controller\Controller" .ucfirst($controller);



if (isset($_POST["action"])){
    $action = $_POST["action"];
    if($action == "connecter"){
        ControllerUtilisateur::connecter();
    }elseif ($action == "change_image") {
        $controllerClassName::$action();
    }
}

// Cas ou l'URL présent une action
if(isset($_GET["action"])){
    $action = $_GET["action"];

    // Action qui redirige vers les pages assignées
    if ($action == "readAll" || $action == "search" || $action == "connection" || $action == "register") {
        $controllerClassName::$action();
    }

    // Action de deconnexion de l'utilisateur
    elseif ($action == "deconnection"){
        ConnexionUtilisateur::deconnecter();
        ControllerAccueil::readAll();
    }

    // Action du controller Utilisateur
    elseif ($controllerClassName == "App\Naturotheque\Controller\ControllerUtilisateur") {
        if ($action == "connected") {
            $controllerClassName::$action();
        } // Action qui enregistre le nouveau utilisateur dans la BD
        elseif ($action == "registered") {
            $data = [
                "nom" => $_GET["nom"],
                "prenom" => $_GET["prenom"],
                "email" => $_GET["email"],
                "password" => $_GET["password"]
            ];

            // Vérifiez si les clés "numero" et "sexe" existent dans $_GET
            $data["numero"] = $_GET["numero"] ?? "Non spécifié";
            $data["sexe"] = $_GET["sexe"] ?? "Non spécifié";

            $data["description"] = null;
            $data["localisation"] = null;
            $data["photo_profil"] = "default-profil.png";
            $data["dnaissance"] = null;
            $data["nbr_vue"] = 0;


            $controllerClassName::$action($data);
        }elseif ($action == "profil" || $action == "edit_profil" || $action =="edit_mdp" || $action == "change_image" || $action == "delete_account") {
            $controllerClassName::$action();
        }elseif ($action == "change_profil") {
            $controllerClassName::$action($_GET["first_name"] , $_GET["last_name"], $_GET["email"],$_GET["date_of_birth"] , $_GET["bio"], $_GET["location"],$_GET["phone_number"]);
        }elseif ($action == "change_mdp") {
            $controllerClassName::$action($_GET["ancient_password"] , $_GET["new_password"], $_GET["confirm_new_password"]);
        }
    }

    // Action du controller Espece
    elseif ( $controllerClassName == "App\Naturotheque\Controller\ControllerEspece"){
        if ($action == "searchBy"){
            $params = array("habitats" => $_GET["habitats"],
                        "taxonomicRanks" => $_GET["taxonomicRanks"],
                        "territories" => $_GET["territories"],
                        "domain" => $_GET["domain"],
                        "image" => $_GET["image"]);

            ControllerEspece::searchBy($_GET["filtre_f"] , $_GET["recherche"], $_GET["page"] , $_GET["size"] , $params);
        }elseif ($action == "moreInfo"){
            ControllerEspece::moreInfo($_GET["taxrefIds"]);
        }
    }


    // Action du controller Naturotheque
    elseif ( $controllerClassName == "App\Naturotheque\Controller\ControllerNaturotheque"){
        if ($action == "enregistrer") {
            echo ($_GET["nom"]);
            ControllerNaturotheque::enregistrer($_GET["id"],$_GET["table"],$_GET["nom"],$_GET["image"]);
        }elseif ($action == "retirer") {
            ControllerNaturotheque::retirer($_GET["id"],$_GET["table"]);
        }elseif ($action == "afficher_naturotheque") {
            UtilisateurRepository::PlusUnVue($_GET["email"]);
            $controllerClassName::$action($_GET["email"]);
        }elseif ($action == "afficher_save" || $action == "afficher_like") {
            $controllerClassName::$action($_GET["email"]);
        }
    }

    // Action inconnue
    else{
        ControllerAccueil::error("Action inconnue");
    }
}else{ // action readAll par défault
    ControllerAccueil::readAll();
}

?>
