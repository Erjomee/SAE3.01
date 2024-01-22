<?php

namespace App\Naturotheque\Controller;

use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Lib\MessageFlash;
use App\Naturotheque\Lib\MotDePasse;
use App\Naturotheque\Model\DataObject\Utilisateur;
use App\Naturotheque\Model\HTTP\Session;
use App\Naturotheque\Model\Repository\DatabaseConnection;
use App\Naturotheque\Model\Repository\NaturothequeRepository;
use App\Naturotheque\Model\Repository\UtilisateurRepository;
use TypeError;
use PDOException;


class ControllerUtilisateur{

    // Méthode qui redirige vers le formulaire de connexion
    public static function connection() : void {
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire de connexion",
                                                                    "style" => "Connexion",
                                                                    "cheminVueBody" => "utilisateur/formulaire_connexion.php"]);
    }


    public static function connecter() : void{
        if (isset($_POST["email"]) && isset($_POST["password"])){
            $utilisateur = (new UtilisateurRepository())->select($_POST["email"]);

            if (isset($utilisateur)){
                if (MotDePasse::verifier($_POST["password"],$utilisateur->get("password"))) {
                    ConnexionUtilisateur::connecter($utilisateur->get("email"));
                    MessageFlash::ajouter("success" , "Vous vous êtes connecté .");    // marche pas
                    header("Location: frontcontroller.php");
                }else{
                    MessageFlash::ajouter("warning" , "Mdp incorrect");
                }
            }else{
                MessageFlash::ajouter("warning" , "Login incorrect");
            }
        }else{
            MessageFlash::ajouter("danger" , "Login and/or mdp non define !");
        }
    }


    // Méthode qui redirige vers le formulaire d'inscription
    public static function register() : void {
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire d'inscription",
                                                                    "style" => "Inscription",
                                                                    "cheminVueBody" => "utilisateur/formulaire_inscription.php"]);
    }

    public static function registered(array $utilisateurFormatTableau):void{
        try{
            if (!($_GET["password"] == $_GET["password2"])){  // Mdp pas correspondant
                MessageFlash::ajouter("warning" , "Mot de passe incompatible !");
                ControllerUtilisateur::register();
            }else {
                $utilisateur = Utilisateur::construireDepuisFormulaire($utilisateurFormatTableau);

                (new UtilisateurRepository())->sauvegarder($utilisateur);
                MessageFlash::ajouter("success" , "La utilisateur a bien été crée ! Connectez vous");
                ControllerUtilisateur::connection();
            }
        }catch (PDOException $e){  // Utilisateur déjà existant
            MessageFlash::ajouter("warning" , "Login déjà existante !");
            ControllerUtilisateur::register();
        }catch (TypeError $e){
            MessageFlash::ajouter("danger" , "Nom, prénom, email ou mdp manquant!");
            ControllerUtilisateur::register();
        }
    }


    public static function getUtilisateurConnecte(): void{
        $users = UtilisateurRepository::getUtilisateurConnecte();
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire d'inscription",
                                                                    "pagetitle" => "Page Naturotheque",
                                                                    "style" => "Naturotheque",
                                                                    "cheminVueBody" => "naturotheque/naturotheque.php",
                                                                    "users" => $users,]);
    }

    public static function profil(): void{
        $utilisateur = (new UtilisateurRepository())->select(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        $nbr_save = count(NaturothequeRepository::selectsave(ConnexionUtilisateur::getLoginUtilisateurConnecte()));
        $nbr_like = count(NaturothequeRepository::selectlike(ConnexionUtilisateur::getLoginUtilisateurConnecte()));
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire d'inscription",
                                                        "style" => "Profil",
                                                        "cheminVueBody" => "utilisateur/profil.php",
                                                        "first_name" => $utilisateur->get("prenom"),
                                                        "last_name" => $utilisateur->get("nom"),
                                                        "email" => $utilisateur->get("email"),
                                                        "photo_profil" => $utilisateur->get("photo_profil"),
                                                        "date_of_birth" => $utilisateur->get("dnaissance"),
                                                        "bio" => $utilisateur->get("description"),
                                                        "location" => $utilisateur->get("localisation"),
                                                        "phone_number" => $utilisateur->get("numero"),
                                                        "nbr_save" => $nbr_save,
                                                        "nbr_like" => $nbr_like,
                                                        "nbr_vue" => $utilisateur->get("nbr_vue")]);
    }

    public static function edit_profil(): void{
        $utilisateur = (new UtilisateurRepository())->select(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire de modification du profil",
                                                        "style" => "EditProfil",
                                                        "script" => "Profil",
                                                        "cheminVueBody" => "utilisateur/edit_profil.php",
                                                        "first_name" => $utilisateur->get("prenom"),
                                                        "last_name" => $utilisateur->get("nom"),
                                                        "email" => $utilisateur->get("email"),
                                                        "photo_profil" => $utilisateur->get("photo_profil"),
                                                        "date_of_birth" => $utilisateur->get("dnaissance"),
                                                        "bio" => $utilisateur->get("description"),
                                                        "location" => $utilisateur->get("localisation"),
                                                        "phone_number" => $utilisateur->get("numero"),]);
    }


    public static function change_profil($first_name, $last_name, $email,$date_of_birth , $bio, $location,$phone_number): void{

        $data = [
            "nom" => $last_name,
            "prenom" => $first_name,
            "email" => $email,
            "password" => null,
            "numero" => $phone_number,
            "sexe" => null,
            "Photo_profil" => null,
            "description" => $bio,
            "localisation" => $location,
            "dnaissance" => $date_of_birth
        ];
        
        $utilisateur = UtilisateurRepository::construire($data);

        UtilisateurRepository::update($utilisateur);

        ConnexionUtilisateur::connecter($email);

        MessageFlash::ajouter("success" , "Profil mis à jour");
        self::edit_profil();
    }


    public static function edit_mdp(): void{
        ControllerUtilisateur::afficheVue("view.php" , [ "pagetitle" => "Formulaire de modification du mdp",
                                                        "style" => "EditMdp",
                                                        "cheminVueBody" => "utilisateur/edit_mdp.php"]);
    }
    
    public static function change_mdp($old_mdp_clair , $new_mdp , $confirm_mdp): void{
        $old_mdp_hash = (new UtilisateurRepository())->select(ConnexionUtilisateur::getLoginUtilisateurConnecte())->get("password");

        if (MotDePasse::verifier($old_mdp_clair , $old_mdp_hash)) {
            if ($new_mdp == $confirm_mdp) {
                $new_mdp_hash = MotDePasse::hacher($new_mdp);
                UtilisateurRepository::update_mdp($new_mdp_hash);
                MessageFlash::ajouter("success" , "Mot de passe modifié");
                self::profil();
            }
            else{
                MessageFlash::ajouter("warning" , "Verfication échoué !");
                self::edit_mdp();
            }
        }else{
            MessageFlash::ajouter("warning" , "Ancien mot de passe incorrect !");
            self::edit_mdp();
        }

    }

    public static function change_image(): void{

        if ($_FILES['images']['error'] === UPLOAD_ERR_OK) {
            $targetDir = __DIR__."\..\..\assets\img\img_profil/";
            $targetFile = $targetDir . str_replace(' ', '', basename($_FILES['images']['name']));
            if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFile)) {
                UtilisateurRepository::update_img(str_replace(' ', '', basename($_FILES['images']['name'])));
            } else {
                echo 'Erreur lors de l\'enregistrement du fichier.';
            }
        } else {
            echo 'Erreur lors de la réception du fichier.';
        }
    }



    public static function delete_account(): void{
        UtilisateurRepository::delete(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        ConnexionUtilisateur::deconnecter();
        ControllerAccueil::readAll();
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



        if(!is_null(MessageFlash::lireTousMessages()) ){
            if (sizeof(MessageFlash::lireTousMessages()) > 0) {
                $message = MessageFlash::lireMessages(array_key_first(MessageFlash::lireTousMessages()));
            }
        }
        require __DIR__ . "/../view/$cheminVue";
    }

    public static function error(string $errorMessage = ""){
        self::afficheVue("view.php" , [ "pagetitle" => "Action incorrect",
            "cheminVueBody" => "error.php",
            "errorMessage" => $errorMessage]);
    }


}

?>