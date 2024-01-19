<?php

namespace App\Naturotheque\Controller;
use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Model\Repository\NaturothequeRepository;
use App\Naturotheque\Model\Repository\UtilisateurRepository;


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


    public static function afficher_naturotheque($user_login){
        // Ma naturotheque
        if($user_login == ConnexionUtilisateur::getLoginUtilisateurConnecte()){
            ControllerNaturotheque::afficheVue("view.php" , [ "pagetitle" => "Ma naturotheque",
                                                                    "style" => "MaNaturotheque",
                                                                    "cheminVueBody" => "naturotheque/ma_naturotheque.php"]);
        // Naturotheque des autres 
        }else {
            $utilisateur = (new UtilisateurRepository())->select($user_login);
            ControllerNaturotheque::afficheVue("view.php" , [ "pagetitle" => "Ma naturotheque",
                                                                    "style" => "VisiteNaturotheque",
                                                                    "cheminVueBody" => "naturotheque/visite_naturotheque.php",
                                                                    "first_name" => $utilisateur->get("prenom"),
                                                                    "last_name" => $utilisateur->get("nom"),
                                                                    "email" => $utilisateur->get("email"),
                                                                    "photo_profil" => $utilisateur->get("photo_profil"),
                                                                    "date_of_birth" => $utilisateur->get("dnaissance"),
                                                                    "bio" => $utilisateur->get("description"),
                                                                    "location" => $utilisateur->get("localisation"),
                                                                    "phone_number" => $utilisateur->get("numero")]);
        }
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