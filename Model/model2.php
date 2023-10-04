<?php
    abstract class move_uploaded_file
    {
        private static $_sdd;
        private static function stbdd(){
            model::$_sdd = new PDO("mysql:host=localhost, dbname= ")
        }
    }



?>