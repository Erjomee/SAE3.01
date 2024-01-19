<?php

namespace App\Naturotheque\Model\Repository;

use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Model\DataObject\Utilisateur;
use DateTime;

class UtilisateurRepository{

    // Méthode vérifiant si un utilisateur est existant dans la BD
    public static function already_exist($email): bool {
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $values = array(
            "email" => $email,
        );
        // Preparation de la requete sql
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute($values);

        // fetch(): renvoie true si la selection n'est pas vide
        $utilisateur = $pdoStatement->fetch();

        if ($utilisateur){
            return true;
        }else{
            return false;
        }
    }

    // Méthode qui construit un objet Utilisateur
    public static function construire(array $utilisateurFormatArray): Utilisateur{
        $nom = $utilisateurFormatArray["nom"];
        $prenom = $utilisateurFormatArray["prenom"];
        $email = $utilisateurFormatArray["email"];
        $password = $utilisateurFormatArray["password"];
        $numero = $utilisateurFormatArray["numero"];
        $sexe = $utilisateurFormatArray["sexe"];
        $photo_profil = $utilisateurFormatArray["Photo_profil"] ;
        $description = $utilisateurFormatArray["description"];
        $localisation = $utilisateurFormatArray["localisation"];
        $dnaissance = $utilisateurFormatArray["dnaissance"];

        return new Utilisateur($nom, $prenom, $email, $password, $numero, $sexe,$photo_profil,$description,$localisation,$dnaissance);
    }

    // Méthode qui sauvegarde le nouvel utilisateur dans la BD
    public static function sauvegarder(Utilisateur $utilisateur):void{
        $sql = "INSERT INTO utilisateur (nom , prenom , email , password , numero , sexe ,description,localisation,dnaissance)
                    VALUES (:nom , :prenom , :email , :password , :numero , :sexe ,:description,:localisation,:dnaissance )";
        $values = array(
            "nom" => $utilisateur->get("nom"),
            "prenom" => $utilisateur->get("prenom"),
            "email" => $utilisateur->get("email"),
            "password" => $utilisateur->get("password"),
            "numero" => $utilisateur->get("numero"),
            "sexe" => $utilisateur->get("sexe"),
            "description" => $utilisateur->get("description"),
            "localisation" => $utilisateur->get("localisation"),
            "dnaissance" => $utilisateur->get("dnaissance")
        );
        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }

    public static function update(Utilisateur $utilisateur):void{
        $sql = "UPDATE utilisateur 
                SET nom = :nom , prenom = :prenom , email = :email , numero = :numero , description = :description , localisation = :localisation , dnaissance = :dnaissance   
                WHERE email = :id";

        $values = array(
            "id" => ConnexionUtilisateur::getLoginUtilisateurConnecte(),
            "nom" => $utilisateur->get("nom"),
            "prenom" => $utilisateur->get("prenom"),
            "email" => $utilisateur->get("email"),
            "numero" => $utilisateur->get("numero"),
            "description" => $utilisateur->get("description"),
            "localisation" => $utilisateur->get("localisation"),
            "dnaissance" => $utilisateur->get("dnaissance")
        );

        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }

    public static function update_img($img):void{
        $sql = "UPDATE utilisateur 
                SET  Photo_profil= :photo_profil   
                WHERE email = :id";

        $values = array(
            "id" => ConnexionUtilisateur::getLoginUtilisateurConnecte(),
            "photo_profil" => $img
        );

        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }
    

    public static function getUtilisateurConnecte(){
        $sql = "SELECT * FROM utilisateur";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute();
        
        // Récupérer les résultats de la requête
        $users = $pdoStatement->fetchAll();


        for ($i=0; $i < sizeof($users); $i++) { 
            if ($users[$i]['Photo_profil'] == null){
                $users[$i]['Photo_profil'] = "profil.jpg";
            }
            if ($users[$i]['sexe'] == null){
                $users[$i]['sexe'] = 'indefini';
            }
        }
        return $users;
    }

    public function select(string $valeurClePrimaire): ?Utilisateur{
        $sql = "SELECT * from utilisateur WHERE email = :valeurClePrimaire";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "valeurClePrimaire" => $valeurClePrimaire,
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $objet = $pdoStatement->fetch();
        // Si la voiture existe
        if ($objet) {
            return UtilisateurRepository::construire($objet);
        }else {
            return null;
        }
    }



    public static function update_mdp($new_password){
        $sql = "UPDATE utilisateur 
                SET password = :new_password 
                WHERE email = :email ";

        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "new_password" => $new_password,
            "email" => ConnexionUtilisateur::getLoginUtilisateurConnecte()
        );

        $pdoStatement->execute($values);
    }


    static function missing_value(Utilisateur $utilisateur): bool
    {
        if ($utilisateur->get("nom")=="" || $utilisateur->get("prenom")=="" || $utilisateur->get("email")=="" || $utilisateur->get("password")=="" ){
            return true ;
        }else{
            return false;
        }
    }



       



}

?>