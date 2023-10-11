<?php

    namespace App\Naturotheque\Controller ;


    class ControllerAccueil{

        public static function readAll() : void {
            ControllerAccueil::afficheVue("view.php" , [ "utilisateurs" => "jerome",
                                                                    "pagetitle" => "Page d'accueil",
                                                                    "cheminVueBody" => "accueil/accueil.php"]);
        }

        // Méthode qui affiche la page error
        public static function error(string $errorMessage = ""){
            ControllerAccueil::afficheVue("view.php" , [ "pagetitle" => "Action incorrect",
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