<?php
    namespace App\Naturotheque\Lib;
    use App\Naturotheque\Model\HTTP\Session;


    class ConnexionUtilisateur{

        // L'utilisateur connecté sera enregistré en session associé à la clé suivante

        private static string $cleConnexion = "_utilisateurConnecte";

        public static function connecter(string $loginUtilisateur): void{
            Session::getInstance()->enregistrer(static::$cleConnexion, $loginUtilisateur);
        }

        public static function estConnecte(): bool{
            return Session::getInstance()->contient(static::$cleConnexion);
        }

        public static function deconnecter(): void{
            if (static::estConnecte()){
                Session::getInstance()->supprimer(static::$cleConnexion);
            }
        }

        public static function getLoginUtilisateurConnecte(): ?string{
            if (static::estConnecte()){
                return Session::getInstance()->lire(static::$cleConnexion);
            }else{
                return null;
            }

        }

        public static function estUtilisateur($login): bool{
            if (self::estConnecte()){
                if (self::getLoginUtilisateurConnecte()==$login){
                    return true;
                }
            }
            return false;
        }

    }


?>