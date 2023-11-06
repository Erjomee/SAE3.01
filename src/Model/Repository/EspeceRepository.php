<?php

namespace App\Naturotheque\Model\Repository;
use App\Naturotheque\Model\DataObject\Espece;

class EspeceRepository{

    public static function cURL(String $url){
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

        return $response;
    }

    public static function getEspece(String $filtre , String $espece , int $page = 1 , int $size = 9){
        $url = "https://taxref.mnhn.fr/api/taxa/search?version=16.0&".$filtre."=".$espece;
        $url = str_replace(" " , "%20" , $url);
        $response = EspeceRepository::cURL($url);

        // Vérification de la réponse à la requête
        if ($response !== false) {
            $data = json_decode($response, true);

            // Vérification de la présence d'espèce ( validité de la recherche )
            if (isset($data['_embedded'])) {
                // Nettoyage
                if ($filtre != "taxrefIds"){
                    $lst_referenceID = [];
                    foreach ($data['_embedded']['taxa'] as $index => $espece) {
                        // On empeche les doublons d'espece
                        if (!in_array($espece["referenceId"], $lst_referenceID)) {
                            $lst_referenceID[] = $espece["referenceId"];
                        }else {  // Suppression des doublons
                            unset($data['_embedded']['taxa'][$index]);
                        }
                    }
                    // On récupère les éléments de la bonne page
                    $nbr_espece = sizeof($lst_referenceID);
                    $max_page =  ceil($nbr_espece /$size);
                    if ($page == 1){  // Page 1
                        $data = array_slice($data['_embedded']['taxa'],0 , $size);

                    }elseif (1 < $page && $page < $max_page){  //Page entre 1 et max_page
                        $min_interval = ($page - 1 )* $size ;
                        $data = array_slice($data['_embedded']['taxa'],$min_interval , $size);

                    }else{ // Page = max_page
                        $data = array_slice($data['_embedded']['taxa'],$page * $size);
                    }
                }else{
                    $data = $data['_embedded']['taxa'];
                }

                // Gestion des media image
                foreach ($data as $index => $espece) {
                    // On récupere les donnée medias à partir de l'url
                    $url_media = "https://taxref.mnhn.fr/api/taxa/{$espece["referenceId"]}/media";
                    $response_media = EspeceRepository::cURL($url_media);
                    $data_media = json_decode($response_media, true);
                    // On vérifie la présence d'image dans media
                    if (isset($data_media["_embedded"])) {
                        $lst_image = [];
                        foreach ($data_media['_embedded']['media'] as $image) {
                            $lst_image[] = $image["_links"]["file"]["href"];
                        }
                        $data[$index]["_links"]["media"] = $lst_image;  // on associe directement la liste au media
                    } else {  // Image introuvable
                        $data[$index]["_links"]["media"] = null;
                    }
                }
                return $data;
            }else{  // Espece introuvable
                return null;
            }
        } else {  // Echec de la requête
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


//    a finir

    // Méthode qui sauvegarde le nouvel utilisateur dans la BD
    public static function sauvegarder(Espece $espece):void{
        $sql = "INSERT INTO espece(id_espece , referenceId , scientificName , fullName , frenchVernacularName , vernacularKingdomName,vernacularClassName,vernacularOrderName,habitat ,pays,media)
                    VALUES (:id_espece , :referenceId , :scientificName , :fullName , :frenchVernacularName , :vernacularKingdomName,:vernacularClassName,:vernacularOrderName,:habitat ,:pays,:media)";
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