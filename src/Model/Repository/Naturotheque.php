<?php
namespace App\Naturotheque\Model\Repository;

use App\Naturotheque\Model\DataObject\Utilisateur;
use DateTime;

class naturotheque {
    public static function alluser() {
        $sql = "SELECT nom, prenom, sexe, photo_profil, dnaissance FROM utilisateur";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute();
        
        // Récupérer les résultats de la requête
        $users = $pdoStatement->fetchAll();

        foreach($users as $util){


            $aujourdhui = new DateTime();
            $utilisateur = new DateTime($util['dnaissance']);

            $age = $aujourdhui -> diff($utilisateur)->y;

            if ($util['photo_profil'] === null) {
                $util['photo_profil'] = '../assets/img/profil.jpg'; 
            }
            if ($util['sexe'] === null) {
                $util['sexe'] = 'indefini'; 
            }


        }
        // echo "vous avez " . $age . "ans";
        // Retourner les utilisateurs
        return $users;
    }
}
