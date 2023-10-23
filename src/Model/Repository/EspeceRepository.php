<?php

namespace App\Naturotheque\Model\Repository;
use App\Naturotheque\Model\DataObject\Espece;

class EspeceRepository{


    public static function getEspece(String $filtre , String $espece){
        $url = "https://taxref.mnhn.fr/api/taxa/search?version=16.0&".$filtre."=".$espece;

        $ch = curl_init($url);

        // Désactiver la vérification du certificat SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
        }
        curl_close($ch);

        if ($response !== false) {
            $data = json_decode($response, true);
//            $id = $data['_embedded']['taxa'][0]['id'];
            return $data;
        } else {
            echo 'La requête a échoué.';
            return null;
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


}

?>