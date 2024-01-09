<?php
namespace App\Naturotheque\Controller ;
use App\Naturotheque\Model\HTTP\Session;
use App\Naturotheque\Model\Repository\EspeceRepository;
use App\Naturotheque\Model\HTTP\Cookie;

class ControllerEspece{

    public static function search():void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)
        ControllerEspece::afficheVue("view.php" , [ "pagetitle" => "Page de recherche d'espece",
                                                                "style" => "Espece",
                                                                "default" => "Veuillez saisir une recherche",
                                                                "cheminVueBody" => "espece/search.php"]);
    }

    public static function searchBy(string $filtre , string $espece , int $page , int $size):void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)


        $data = EspeceRepository::getEspece($filtre , $espece ,$page,$size );
        $result = "";

        if (isset($data)) {  // La recherche contient des especes
            foreach ($data as $espece) {
                if (isset($espece["_links"]["media"])){
                    $image = $espece["_links"]["media"][0];
                }else{
                    $image = '../assets/img/img_not_found.png';
                }

                $result .= "<div class='item'>
                        <img class='img-carte' src={$image}>
                        <div class='information'>
                            <p class='nom-espece'>{$espece['frenchVernacularName']}</p>
                            <hr>
                            <button class='btn_detail' name='id' value={$espece['id']} onclick='more_info({$espece['id']})'> Détails</button>
                            <p>{$espece['fullNameHtml']}</p>
                            <p>ID:{$espece['id']}</p>
                        </div>
                    </div>";
            }
            $paquet = array( "default" => "<h3>Résultat de la recherche:</h3>",
                "result" => $result);

        }else{  // aucun résultat
            $paquet = array( "default" => "<h1>Espece introuvable<h1>",
                "result" => null);
        }

        $json_data = json_encode($paquet);


        header('Content-Type: application/json');
        echo $json_data ;
    }


    public static function moreInfo(string $id):void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)


        $data = EspeceRepository::getEspece("taxrefIds" , $id , 1,1);
        $result = "";
        $image = "";

        if (isset($data)){  // La recherche contient des especes
            foreach ($data as $espece) {
                if (isset($espece["_links"]["media"])){ // Si le taxon présente des images
                    if(sizeof($espece["_links"]["media"]) == 1 ){  // Si il ne contient qu'une image
                        $image .= "<img src='{$espece["_links"]["media"][0]}' alt='img1' class='img__slider active'/>";
                    }else {  // Plusieurs images
                        for ($i = 0; $i < sizeof($espece["_links"]["media"]); $i++) {
                            $num_img = $i + 1;
                            if ($i == 0) {  // On initialise la premiere image en active
                                $image .= "<img src='{$espece["_links"]["media"][$i]}' alt='img{$num_img}' class='img__slider active'/>";
                            } else {
                                $image .= "<img src='{$espece["_links"]["media"][$i]}' alt='img{$num_img}' class='img__slider'/>";
                            }
                        }
                        // On donne l'accès au bouton précedent-suivant
                        $image .= "<div class='suivant'>
                                    <i class='fas fa-chevron-circle-right fa-xs' style='color: #ffffff;'></i>
                                </div>
                                <div class='precedent'>
                                    <i class='fas fa-chevron-circle-left fa-xs' style='color: #ffffff;'></i>
                                </div> ";
                    }
                }else{ // Pas d'image présente
                    $image .= "<img src='../assets/img/img_not_found.png' alt='img1' class='img__slider active'/>";
                }

                $result .= "<div class='item'>
                        <img class='img-carte' src={$image}>
                        <div class='information'>
                            <p class='nom-espece'>{$espece['frenchVernacularName']}</p>
                            <hr>
                            <button class='btn_detail' name='id' value={$espece['id']} onclick='more_info({$espece['id']})'> Détails</button>
                            <p>{$espece['fullNameHtml']}</p>
                            <p>ID:{$espece['id']}</p>
                        </div>
                    </div>";
            }
            $paquet = array("description" => EspeceRepository::getDescription($id),
                "result" => $data,
                "image" => $image,
                );
        }else{  // aucun résultat
            $paquet = array( "default" => "<h1>Espece introuvable<h1>",
                "result" => null);
        }

        $json_data = json_encode($paquet);
        header('Content-Type: application/json');
        echo $json_data ;
    }



    // Méthode qui permet d'afficher la vue avec son chemin et ses parametres
    private static function afficheVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }
}?>
