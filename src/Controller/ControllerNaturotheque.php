<?php

namespace App\Naturotheque\Controller;


class ControllerNaturotheque{

    public static function readAll() : void {
        ControllerNaturotheque::afficheVue("view.php" ,[ "utilisateurs" => "jerome",
                                                         "pagetitle" => "Page d'accueil",
                                                         "cheminVueBody" => "naturotheque/naturotheque.php"]);
    }

    // Méthode qui affiche la page error
    public static function error(string $errorMessage = ""){
        ControllerNaturotheque::afficheVue("view.php" , [ "pagetitle" => "Action incorrect",
                                                          "cheminVueBody" => "error.php",
                                                          "errorMessage" => $errorMessage]);
    }

    // Méthode qui permet d'afficher la vue avec son chemin et ses parametres
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }

}

?>