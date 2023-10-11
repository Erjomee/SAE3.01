<?php

namespace App\Naturotheque\Controller;
use App\Naturotheque\Model\Repository\UtilisateurRepository;


class ControllerUtilisateur{

    // Méthode qui redirige vers le formulaire de connexion
    public static function connection() : void {
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire de connexion",
                                                                    "cheminVueBody" => "utilisateur/formulaire_connexion.php"]);
    }

    // Méthode qui redirige vers le formulaire d'inscription
    public static function register() : void {
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire d'inscription",
                                                                    "display" => 'none' ,
                                                                    "cheminVueBody" => "utilisateur/formulaire_inscription.php"]);
    }

    // Méthode qui enregistre le nouvel utilisateur dans la BD
    public static function registered($utilisateurFormatArray): void {
        if (UtilisateurRepository::already_exist($utilisateurFormatArray["email"])){
            ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire d'inscription",
                                                                        "display" => 'block' ,
                                                                        "cheminVueBody" => "utilisateur/formulaire_inscription.php"]);

        }else{
            $utilisateur = UtilisateurRepository::construire($utilisateurFormatArray);
            UtilisateurRepository::sauvegarder($utilisateur);
            ControllerAccueil::readAll();
        }
    }

    // Méthode qui permet d'afficher la vue avec son chemin et ses parametres
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }

}

?>