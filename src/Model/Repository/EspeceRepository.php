<?php

namespace App\Naturotheque\Model\Repository;
use App\Naturotheque\Model\DataObject\Espece;
use PDO;


class EspeceRepository{
    // Liste des territoires de TAXREF
    public static $territoire = array(
            "fr"=> " France",
            "gf"=> " Guyane",
            "mar"=> " Martinique",
            "gua"=> " Guadeloupe",
            "sm" => " Saint-Martin",
            "sb"=> " Saint-Barthélemy",
            "spm"=> " Saint-Pierre-et-Miquelon",
            "may"=> " Mayotte",
            "epa"=> " Îles Eparses",
            "reu"=> " Réunion",
            "sa"=> " Îles subantarctiques",
            "ta"=> " Terre Adélie",
            "nc"=> " Nouvelle-Calédonie",
            "wf"=> " Wallis et Futuna",
            "pf"=> " Polynésie française",
            "cli"=> " Île de Clipperton",
    );

    // Méthode qui effectue une requête cURL avec les bon parametrage
    public static function cURL(String $url){
        $ch = curl_init($url);

        // Désactive la vérification du certificat SSL du serveur distant lors de la connexion
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Désactive la vérification du nom d'hôte (hostname) dans le certificat SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // Résultat de la requête sous forme de chaîne de caractères
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch); // Execute et stock le résultat de la requête

        // En cas d'erreur
        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
        }

        // Fermeture de la session cURL
        curl_close($ch);

        return $response;
    }

    public static function getEspece(String $filtre , String $espece , int $page = 1 , int $size = 9){

        // refaire le systeme de pagination en prenant
        // https://taxref.mnhn.fr/api/taxa/search?version=16.0&frenchVernacularNames=pinson&size=0
        // la clé "page"

        $url = "https://taxref.mnhn.fr/api/taxa/search?version=16.0&".$filtre."=".$espece;
        $url = str_replace(" " , "%20" , $url); // gestion des espaces
        $response = EspeceRepository::cURL($url);

        // Vérification de la réponse à la requête
        if ($response !== false) {
            $data = json_decode($response, true);

            // Vérification de la présence d'espèce (validité de la recherche)
            if (isset($data['_embedded'])){
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

                // On réarrange le json
                foreach ($data as $index => $espece) {
                    // Gestion de l'habitat
                    if (isset($espece["habitat"])){
                        $habitat = EspeceRepository::getHabitat($espece["habitat"]);
                        $data[$index]["habitat"] = ["id" => $habitat["id"],"name" =>$habitat["name"] , "definition" => $habitat["definition"]];
                    }

                    //Gestion des informations biogéographiques
                    
                    $statuts_data = [];
                    
                    foreach (EspeceRepository::$territoire as $key => $value) {
                        $code_statut = $data[$index][$key];
                        if (isset($code_statut)) {
                            if (!array_key_exists($code_statut, $statuts_data)) {
                                $statut = EspeceRepository::getStatuts($code_statut);
                                $statuts_data[$code_statut] = ["zone" => [$value] , "statut" => $code_statut  , "description"=> $statut["description"]  ,"definition" => $statut["definition"]];
                            }else {
                                $statuts_data[$code_statut]["zone"][] = $value;
                            }
                            $statut = EspeceRepository::getStatuts($code_statut);
                            $data[$index][$key] = ["zone" => $value , "statut" => $data[$index][$key]  , "description"=> $statut["description"]  ,"definition" => $statut["definition"]];
                        }
                    }
                    if (!empty($statuts_data)) {
                        $data[$index]["statuts"] = $statuts_data;
                    }else{
                        $data[$index]["statuts"] = null;
                    }

                    // Classification
                    if (isset($espece["_links"]["classification"])) {
                        $data[$index]["classification"] = EspeceRepository::getClassification($espece["referenceId"],$espece["kingdomName"],$espece["phylumName"],$espece["className"],$espece["orderName"],$espece["familyName"],$espece["genusName"]);
                    }

                    // Map
                    $data[$index]["gbifId"] = EspeceRepository::getIdGBIF($espece["referenceId"]);

                    //Gestion des media image
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

    // Méthode qui renvoie les infos en fonction avec l'id d'habitat
    private static function getHabitat(string $id){
        $sql = "SELECT id, name, definition FROM habitat WHERE id = :id";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT); // Liaison sécurisée de la valeur de l'ID
        $pdoStatement->execute(); // Exécution de la requête

        $row = $pdoStatement->fetch(PDO::FETCH_ASSOC); // Récupération des résultats
        return $row;
    }


    // Méthode qui renvoie la fiche descriptive d'une espece
    public static function getStatuts(string $code){

        $sql = "SELECT statut, description, definition FROM statut_geo WHERE statut = :statut";
        $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
        $pdoStatement->bindValue(':statut', $code, PDO::PARAM_STR); // Liaison sécurisée de la valeur de l'ID
        $pdoStatement->execute(); // Exécution de la requête

        $row = $pdoStatement->fetch(PDO::FETCH_ASSOC); // Récupération des résultats
        return $row;
    }


    // Méthode qui renvoie la fiche descriptive d'une espece
    public static function getDescription(int $id){
        $url = "https://taxref.mnhn.fr/api/taxa/{$id}/factsheet";
        $response = EspeceRepository::cURL($url);
        $data = json_decode($response, true);

        return $data;
    }

    // Méthode qui renvoie la classification d'une espece
    public static function getClassification(int $id , mixed $kingdom , mixed $phylum,mixed $classe, mixed $order , mixed $family , mixed $genus){
        $url = "https://taxref.mnhn.fr/api/taxa/{$id}/classification";
        $response = EspeceRepository::cURL($url);
        $data = json_decode($response, true);

        if (isset($data["_embedded"]["taxa"])) {
            // Listes des rang de classifications principaux
            $classification = ["domainName" => null,"kingdomName" => null,"phylumName" => null , "className" => null,
            "orderName" => null , "familyName" => null , "genusName" => null];
            
            $classificationFR = ["Domaine" => [],"Règne" => [],"Phylum" => [] , "Classe" => [],
            "Ordre" => [] , "Famille" => [] , "Genre" => []];

            $rang_courant = "";
            foreach ($data["_embedded"]["taxa"] as $key => $value) {
                if (array_key_exists($value["rankName"] , $classificationFR)) {
                    $rang_courant = $value["rankName"];
                }
                $classificationFR[$rang_courant][] = [$value["rankName"] => $value["scientificName"]];
            }
        }

        $classificationFR["Règne"][0] = ["Règne" => $kingdom];
        $classificationFR["Phylum"][0] = ["Phylum" => $phylum];
        $classificationFR["Classe"][0] = ["Classe" => $classe];
        $classificationFR["Ordre"][0] = ["Ordre" => $order];
        $classificationFR["Famille"][0] = ["Famille" => $family];
        $classificationFR["Genre"][0] = ["Genre" => $genus];
        
        return $classificationFR;
    }

    public static function getInteraction(int $id){
        // à faire
        return ;
    }


    //Méthode qui renvoie l'id GBIF de l'espece à partir de l'id TAXREF
    public static function getIdGBIF(int $id){
        $url = "https://taxref.mnhn.fr/api/taxa/{$id}/externalIds";
        $response = EspeceRepository::cURL($url);
        $data = json_decode($response, true);

        foreach ($data["_embedded"]["externalDb"] as $key => $value) {
            if ($value["externalDbName"] == "GBIF") {
                return $value["externalId"];
            }
        }

        return null;
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

}

?>