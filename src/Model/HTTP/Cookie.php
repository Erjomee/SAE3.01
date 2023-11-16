<?php

    namespace App\Naturotheque\Model\HTTP;

    class Cookie{

        // Méthode qui permet d'enregistrer un cookie
        public static function enregistrer(string $cle, mixed $valeur, ?int $dureeExpiration = null): void{
            $var = serialize($valeur);
            if ($dureeExpiration === null){
                setcookie($cle , $var, 0);
            }else{
                setcookie($cle , $var , time() + $dureeExpiration);
            }
        }

        // Méthode qui permet de lire un cookie
        public static function lire(string $cle): mixed{
            return unserialize($_COOKIE[$cle]);
        }

        // Méthode qui vérifie si un cookie est présent
        public static function contient($cle) : bool{
            if(isset($_COOKIE[$cle])){
                return true;
            }else{
                return false;
            }
        }

        // Méthode qui supprime un cookie
        public static function supprimer($cle) : void {
            unset($_COOKIE[$cle]);
            setcookie ($cle, "", 1);
        }


    }

?>