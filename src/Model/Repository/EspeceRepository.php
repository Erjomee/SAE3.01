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
//            $id = $data['_embedded']['taxa'][0]['id'];
            return json_decode($response, true);
        } else {
            echo 'La requête a échoué.';
            return null;
        }
    }

                // A FAIRE
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

    // Méthode qui sauvegarde le nouvel utilisateur dans la BD
    public static function sauvegarder(Espece $espece):void{
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