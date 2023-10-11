<?php

    namespace App\Naturotheque\Model\DataObject;


    class Utilisateur{
        private $nom;
        private $prenom;
        private $email;
        private $password;
        private $numero;
        private $sexe;

        // Méthode get avec en parametre un attribut de class
        public function get($property) {
            if (property_exists($this, $property)) {
                return $this->{$property};
            }
            return null; // Gérer le cas où la propriété n'existe pas
        }


        // Méthode set avec en parametre un attribut de class et sa nouvel valeur
        public function set($property, $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
            return null;
        }


        public function __construct($nom, $prenom, $email, $password, $numero, $sexe) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->password = $password;
            $this->numero = $numero;
            $this->sexe = $sexe;
        }


    }

?>