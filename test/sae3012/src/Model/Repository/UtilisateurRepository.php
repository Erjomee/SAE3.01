<?php

namespace App\Naturotheque\Model\Repository;
use App\Naturotheque\Model\DataObject\Utilisateur;

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

        return new Utilisateur($nom, $prenom, $email, $password, $numero, $sexe);
    }

    // Méthode qui sauvegarde le nouvel utilisateur dans la BD
    public static function sauvegarder(Utilisateur $utilisateur):void{
        $sql = "INSERT INTO utilisateur (nom , prenom , email , password , numero , sexe)
                    VALUES (:nom , :prenom , :email , :password , :numero , :sexe)";
        $values = array(
            "nom" => $utilisateur->get("nom"),
            "prenom" => $utilisateur->get("prenom"),
            "email" => $utilisateur->get("email"),
            "password" => $utilisateur->get("password"),
            "numero" => $utilisateur->get("numero"),
            "sexe" => $utilisateur->get("sexe")
        );
        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }


//        public static function getUtilisateurConnecte(): Utilisateur{
//
//        }

}

?>