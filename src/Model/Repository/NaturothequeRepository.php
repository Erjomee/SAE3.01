<?php
namespace App\Naturotheque\Model\Repository;
use PDO;

class NaturothequeRepository {

    // Méthode qui sauvegarde l'enregistrement d'une espece en fonction de l'utilisateur
    public static function sauvegarder($id_utilisateur ,$id_espece,$nom,$image,$table):void{
        if ($table == "naturotheque") {
            $sql = "INSERT INTO naturotheque (id_utilisateur , id_espece , nom  , image)
            VALUES (:id_utilisateur , :id_espece , :nom  , :image)";
        }elseif ($table == "aime") {
            $sql = "INSERT INTO aime (id_utilisateur , id_espece , nom  , image)
            VALUES (:id_utilisateur , :id_espece , :nom , :image)";
        }
        
        $values = array(
            "id_utilisateur" =>$id_utilisateur,
            "id_espece" => $id_espece,
            "nom" => $nom,
            "image" => $image
        );
        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }

    // Méthode qui sauvegarde l'enregistrement d'une espece en fonction de l'utilisateur
    public static function supprimer($id_utilisateur , $id_espece , $table):void{
        if ($table == "naturotheque") {
            $sql = "DELETE FROM naturotheque WHERE id_utilisateur = :id_utilisateur AND id_espece = :id_espece";
        }elseif ($table == "aime") {
            $sql = "DELETE FROM aime WHERE id_utilisateur = :id_utilisateur AND id_espece = :id_espece";
        }
        $values = array(
            "id_utilisateur" =>$id_utilisateur,
            "id_espece" => $id_espece,
        );

        $pdoStatement = DatabaseConnection::getPdo() ->prepare($sql) ;
        $pdoStatement->execute($values);
    }


    // Méthode qui selection une ligne de la table
    public static function select($id_utilisateur , $id_espece , $table){
        if ($table == "naturotheque") {
            $sql = "SELECT * from naturotheque WHERE id_utilisateur = :id_utilisateur AND id_espece = :id_espece";
        }elseif($table == "aime"){
            $sql = "SELECT * from aime WHERE id_utilisateur = :id_utilisateur AND id_espece = :id_espece";
        }
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

    public static function selectsave($id_utilisateur){
        $sql = "SELECT * FROM naturotheque where id_utilisateur = :id_utilisateur ";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array("id_utilisateur" => $id_utilisateur);
        $pdoStatement->execute($values);

        $objet = $pdoStatement->fetchAll();

        return $objet;
    }
    
    public static function selectlike($id_utilisateur){
        $sql = "SELECT * FROM aime where id_utilisateur = :id_utilisateur ";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array("id_utilisateur" => $id_utilisateur);
        $pdoStatement->execute($values);

        $objet = $pdoStatement->fetchAll();

        return $objet;
    }

    public static function selectSum($id_utilisateur){
        $sql = "SELECT (SELECT COUNT(*) FROM naturotheque WHERE id_utilisateur = :id_utilisateur) +
                       (SELECT COUNT(*) FROM aime WHERE id_utilisateur = :id_utilisateur) as total_count";
        
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $values = array("id_utilisateur" => $id_utilisateur);
        $pdoStatement->execute($values);
        
        $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        
        return $result['total_count'];
    }


}
