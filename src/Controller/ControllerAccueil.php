<?php

namespace App\Naturotheque\Controller;

use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Model\Repository\UtilisateurRepository;

class ControllerAccueil{

    public static function readAll() : void {
        ControllerAccueil::afficheVue("view.php" , [ "utilisateurs" => "jerome",
                                                                "pagetitle" => "Page d'accueil",
                                                                "style" => "Accueil",
                                                                "script" => "Accueil",
                                                                "cheminVueBody" => "accueil/accueil.php"]);
    }

    // Méthode qui affiche la page error
    public static function error(string $errorMessage = ""){
        ControllerAccueil::afficheVue("view.php" , [ "utilisateurs" => "jerome",
                                                                "pagetitle" => "Action incorrect",
                                                                "style" => "Accueil",
                                                                "script" => "Accueil",
                                                                "cheminVueBody" => "error.php",
                                                                "errorMessage" => $errorMessage]);
    }

    // Méthode qui permet d'afficher la vue avec son chemin et ses parametres
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        if (ConnexionUtilisateur::estConnecte()) {
            $utilisateur = (new UtilisateurRepository())->select(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            $parametres["utilisateur"] = $utilisateur;
        }else{
            $parametres["utilisateur"] = null;
        }

        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }

}

?>