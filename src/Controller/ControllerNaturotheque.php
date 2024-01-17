<?php

namespace App\Naturotheque\Controller;
use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Model\Repository\NaturothequeRepository;

class ControllerNaturotheque{

    public static function readAll() : void {
        ControllerUtilisateur::getUtilisateurConnecte();
    }

    // Méthode qui affiche la page error
    public static function error(string $errorMessage = ""){
        ControllerNaturotheque::afficheVue("view.php" , [ "pagetitle" => "Action incorrect",
                                                          "cheminVueBody" => "error.php",
                                                          "errorMessage" => $errorMessage]);
    }


    public static function enregistrer($id_espece ,$table) : void {
        if (ConnexionUtilisateur::estConnecte()) {
            NaturothequeRepository::sauvegarder(ConnexionUtilisateur::getLoginUtilisateurConnecte(),$id_espece,$table);
        }else {
            ControllerUtilisateur::register();
        }
    }

    public static function retirer($id_espece,$table) : void {
        if (ConnexionUtilisateur::estConnecte()) {
            NaturothequeRepository::supprimer(ConnexionUtilisateur::getLoginUtilisateurConnecte(),$id_espece,$table);
        }
    }

    public static function deja_enregistrer($id_espece,$table): bool{
        if (NaturothequeRepository::select(ConnexionUtilisateur::getLoginUtilisateurConnecte() , $id_espece , $table)){
            return true;
        }
        return false;
    }

    // Méthode qui permet d'afficher la vue avec son chemin et ses parametres
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }

}

?>