<?php
    namespace App\Naturotheque\Lib;

    class MessageFlash{
        // Les messages sont enregistrés en session associée à la clé suivante
        private static string $cleFlash = "_messagesFlash";

        // $type parmi "success", "info", "warning" ou "danger"
        public static function ajouter(string $type, string $message): void{
            if(!isset($_SESSION[static::$cleFlash])){
                $_SESSION[static::$cleFlash] = array();
            }
            $_SESSION[static::$cleFlash][$type] = $message;
        }

        public static function contientMessage(string $type): bool{
            return isset($_SESSION[static::$cleFlash][$type]);
        }

        // Attention : la lecture doit détruire le message
        public static function lireMessages(string $type): ?array{
            if(isset($_SESSION[static::$cleFlash])) {
                $message = array($type, $_SESSION[static::$cleFlash][$type]);
                unset($_SESSION[static::$cleFlash][$type]);
                return $message;
            }else{
                return null;
            }
        }

        public static function lireTousMessages() : ?array{
            if(isset($_SESSION[static::$cleFlash])) {
                return $_SESSION[static::$cleFlash];
            }else{
                return null;
            }
        }
    }
?>



