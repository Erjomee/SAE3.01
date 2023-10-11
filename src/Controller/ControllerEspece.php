<?php
namespace App\Naturotheque\Controller ;

class ControllerEspece{

    public static function search():void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)

        ControllerEspece::afficheVue("view.php" , [ "pagetitle" => "Recherche d'une espece ",
                                                                "cheminVueBody" => "espece/search.php"]);

    }


    // Méthode qui permet d'afficher la vue avec son chemin et ses parametres
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }
}

?>