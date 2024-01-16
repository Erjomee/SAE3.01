<?php
namespace App\Naturotheque\Model\Repository;


class NaturothequeRepository {

    // Méthode qui sauvegarde l'enregistrement d'une espece en fonction de l'utilisateur
    public static function sauvegarder($id_utilisateur , $id_espece):void{
        $sql = "INSERT INTO naturotheque (id_utilisateur , id_espece)
                    VALUES (:id_utilisateur , :id_espece)";
        $values = array(
            "id_utilisateur" =>$id_utilisateur,
            "id_espece" => $id_espece,
        );
        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }

    // Méthode qui sauvegarde l'enregistrement d'une espece en fonction de l'utilisateur
    public static function supprimer($id_utilisateur , $id_espece):void{
        $sql = "DELETE FROM naturotheque WHERE id_utilisateur = :id_utilisateur AND id_espece = :id_espece";
        $values = array(
            "id_utilisateur" =>$id_utilisateur,
            "id_espece" => $id_espece,
        );
        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }


    // Méthode qui selection une ligne de la table
    public static function select($id_utilisateur , $id_espece){
        $sql = "SELECT * from naturotheque WHERE id_utilisateur = :id_utilisateur AND id_espece = :id_espece";
        // Préparation de la requête
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array(
            "id_utilisateur" => $id_utilisateur,
            "id_espece" => $id_espece,
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);
        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $objet = $pdoStatement->fetch();
        // Si la voiture existe
        if ($objet) {
            return $objet;
        }else {
            return null;
        }
    }
}
