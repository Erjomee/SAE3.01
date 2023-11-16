<?php
namespace App\Naturotheque\Controller ;
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

        if (isset($data)) {
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
                            <button class='btn_detail' name='id' value={$espece['id']}> Détails</button>
                            <p>{$espece['fullNameHtml']}</p>
                            <p>ID:{$espece['id']}</p>
                        </div>
                    </div>";
            }
            $paquet = array( "default" => "<h3>Résultat de la recherche:</h3>",
                "result" => $result);
        }else{
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
