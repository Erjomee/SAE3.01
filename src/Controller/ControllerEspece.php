<?php
namespace App\Naturotheque\Controller ;

use App\Naturotheque\Lib\ConnexionUtilisateur;
use App\Naturotheque\Model\HTTP\Session;
use App\Naturotheque\Model\Repository\EspeceRepository;
use App\Naturotheque\Model\HTTP\Cookie;
use App\Naturotheque\Model\Repository\UtilisateurRepository;


class ControllerEspece{

    public static function search():void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)
        ControllerEspece::afficheVue("view.php" , [ "pagetitle" => "Page de recherche d'espece",
                                                                "style" => "Espece",
                                                                "script" => "Espece",
                                                                "default" => "Veuillez saisir une recherche",
                                                                "cheminVueBody" => "espece/search.php"]);
    }

    public static function searchBy(string $filtre , string $espece , int $page , int $size , array $params):void {
        // Retrouver toutes les anciennes recherche d'espece enregister dans une table historique (à creer
        //  et les afficher sous forme d'image en bas de la barre de recherche  (PARTIE MODELE)

        $data = EspeceRepository::getEspece($filtre , $espece ,$page,$size,$params);
        $result = "";
        $utilisateurconnecte = false;

        if (ConnexionUtilisateur::estConnecte()) {
            $utilisateurconnecte = true;
        }
        if (isset($data[0])) {  // La recherche contient des especes
            foreach ($data[0] as $espece) {
                if (isset($espece["_links"]["media"])){
                    $image = $espece["_links"]["media"][0];
                }else{
                    $image = '../assets/img/img_not_found.png';
                }

                $result .= "<div class='item' >
                        <img class='img-carte' src={$image} onclick='more_info({$espece['id']})'>
                        <div class='information' onclick='more_info({$espece['id']})'>
                            <p class='nom-espece'>{$espece['frenchVernacularName']}</p>
                            <hr>
                            <p>{$espece['fullNameHtml']}</p>
                            <p>ID:{$espece['id']}</p>
                        </div>";

                if ($utilisateurconnecte) {
                    $frenchVernacularNameModified = str_replace("'", "%27", $espece['frenchVernacularName']);
                    if (!ControllerNaturotheque::deja_enregistrer($espece['id'],"naturotheque")) {
                        $result .= "<button id={$espece['id']}naturotheque name='id' value={$espece['id']} class='bx bx-bookmarks btn_save' onclick='enregistrer({$espece['id']}, \"naturotheque\" ,\"{$frenchVernacularNameModified}\",\"{$image}\")'></button>";
                    }else{
                        $result .= "<button id={$espece['id']}naturotheque name='id' value={$espece['id']} class='bx bx-check btn_save' onclick='retirer({$espece['id']},\"naturotheque\")'></button>";
                    }

                    if (!ControllerNaturotheque::deja_enregistrer($espece['id'],"aime")) {
                        $result .= "<button id={$espece['id']}aime name='id' value={$espece['id']} class='bx bx-heart btn_like' onclick='enregistrer({$espece['id']}, \"aime\",\"{$frenchVernacularNameModified}\", \"{$image}\")'></button>
                                    </div>";
                    }else{
                        $result .= "<button id={$espece['id']}aime name='id' value={$espece['id']} class='bx bxs-heart btn_like' onclick='retirer({$espece['id']},\"aime\")'></button>
                                    </div>";
                    }
                }else{
                    $result .= "<a href='frontController.php?controller=utilisateur&action=connection'><button name='id' value={$espece['id']} class='bx bx-bookmarks btn_save'></button></a>
                                <a href='frontController.php?controller=utilisateur&action=connection'><button name='id' value={$espece['id']} class='bx bx-heart btn_like'></button></a>
                    </div>";
                }
            }
            // <button class='btn_save' name='id' value={$espece['id']} onclick='more_info({$espece['id']})'> Détails</button>
        
            
            $paquet = array( "default" => "",
                "result" => $result,
                "nbr_page" => $data[1],
                "data"=> $data[0]);

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


        $data = EspeceRepository::getEspece("taxrefIds" , $id , 1,1 ,array("image" => 0));
        $result = "";
        $image = "";
        $like_save = "";

        $utilisateurconnecte = false;

        if (ConnexionUtilisateur::estConnecte()) {
            $utilisateurconnecte = true;
        }

        // $test=$data[0][0]['_links']['media'];
        // var_dump($test["href"]);

        if (isset($data[0])){  // La recherche contient des especes
            foreach ($data[0] as $espece) {
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

                if ($utilisateurconnecte) {
                    $frenchVernacularNameModified = str_replace("'", "%27", $espece['frenchVernacularName']);
                    if (!ControllerNaturotheque::deja_enregistrer($espece['id'],"naturotheque")) {
                        $like_save .= "<button id={$espece['id']}naturotheque name='id' value={$espece['id']} class='bx bx-bookmarks btn_save' onclick='enregistrer({$espece['id']}, \"naturotheque\" ,\"{$frenchVernacularNameModified}\",\"{$image}\")'></button>";
                    }else{
                        $like_save .= "<button id={$espece['id']}naturotheque name='id' value={$espece['id']} class='bx bx-check btn_save' onclick='retirer({$espece['id']},\"naturotheque\")'></button>";
                    }

                    if (!ControllerNaturotheque::deja_enregistrer($espece['id'],"aime")) {
                        $like_save .= "<button id={$espece['id']}aime name='id' value={$espece['id']} class='bx bx-heart btn_like' onclick='enregistrer({$espece['id']}, \"aime\",\"{$frenchVernacularNameModified}\", \"{$image}\")'></button>
                                    </div>";
                    }else{
                        $like_save .= "<button id={$espece['id']}aime name='id' value={$espece['id']} class='bx bxs-heart btn_like' onclick='retirer({$espece['id']},\"aime\")'></button>
                                    </div>";
                    }
                }else{
                    $like_save .= "<a href='frontController.php?controller=utilisateur&action=connection'><button name='id' value={$espece['id']} class='bx bx-bookmarks btn_save'></button></a>
                                <a href='frontController.php?controller=utilisateur&action=connection'><button name='id' value={$espece['id']} class='bx bx-heart btn_like'></button></a>
                    </div>";
                }
            }
            $paquet = array("description" => EspeceRepository::getDescription($id),
                "result" => $data[0],
                "image" => $image,
                // "like_save" => $like_save,
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
        if (ConnexionUtilisateur::estConnecte()) {
            $utilisateur = (new UtilisateurRepository())->select(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            $parametres["utilisateur"] = $utilisateur;
        }else{
            $parametres["utilisateur"] = null;
        }

        extract($parametres); // Crée des variables à partir du tableau $parametres

        require __DIR__ . "/../view/$cheminVue";
    }
}?>
