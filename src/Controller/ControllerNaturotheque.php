<?php

namespace App\Naturotheque\Controller;
use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Model\Repository\NaturothequeRepository;
use App\Naturotheque\Model\Repository\UtilisateurRepository;
use App\Naturotheque\Model\Repository\EspeceRepository;


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


    public static function enregistrer($id_espece ,$table,$nom,$image) : void {
        if (ConnexionUtilisateur::estConnecte()) {
            NaturothequeRepository::sauvegarder(ConnexionUtilisateur::getLoginUtilisateurConnecte(),$id_espece,$nom,$image,$table);
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
                                                                    "user_login" => $user_login,
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


    public static function afficher_save($user_login){
        $lst_id_save = NaturothequeRepository::selectSave($user_login);
        
        // $lst_espece_save = [];

        // // boucle for
        // foreach ($lst_id_save as $key => $value) {
        //     $lst_espece_save[] = EspeceRepository::getEspece("taxrefIds" , $value["id_espece"] ,1,12,array("image" => 0))[0];
        // }

        // $paquet = array( 
        //         "data" => $lst_espece_save,
        //         "nbr_page" => 0);


        $json_data = json_encode($lst_id_save);
        header('Content-Type: application/json');
        echo $json_data ;
    }


    public static function afficher_like($user_login){
        $lst_id_like = NaturothequeRepository::selectLike($user_login);

        // $lst_espece_like = [];

        // foreach ($lst_id_like as $key => $value) {
        //     $lst_espece_like[] = EspeceRepository::getEspece("taxrefIds" , $value["id_espece"] ,1,12,array())[0];
        // }
        
        // $paquet = array( 
        //         "data" => $lst_espece_like,
        //         "nbr_page" => 0);


        $json_data = json_encode($lst_id_like);
        header('Content-Type: application/json');
        echo $json_data ;
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