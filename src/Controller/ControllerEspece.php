<?php
namespace App\Naturotheque\Controller ;
use App\Naturotheque\Model\Repository\EspeceRepository;

class ControllerEspece{

    public static function search():void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)
        ControllerEspece::afficheVue("view.php" , [ "pagetitle" => "Page de recherche d'espece",
                                                                "style" => "Espece",
                                                                "default" => "Veuillez saisir une recherche",
                                                                "cheminVueBody" => "espece/search.php"]);
    }

    public static function searchBy(string $filtre , string $espece):void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)

        $data = EspeceRepository::getEspece($filtre , $espece);

        if (isset($data["_embedded"])){
            ControllerEspece::afficheVue("view.php" , [ "pagetitle" => "Page de recherche d'espece",
                                                                    "style" => "Espece",
                                                                    "data" => $data,
                                                                    "cheminVueBody" => "espece/search.php",]);
        }else{
            ControllerEspece::afficheVue("view.php" , [ "pagetitle" => "Page de recherche d'espece",
                                                                    "style" => "Espece",
                                                                    "data" => null,
                                                                    "cheminVueBody" => "espece/search.php",]);
        }
    }



    // Méthode qui permet d'afficher la vue avec son chemin et ses parametres
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }
}

?>