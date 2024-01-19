<?php

namespace App\Naturotheque\Model\DataObject;
use App\Naturotheque\Lib\MotDePasse;

class Utilisateur{
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $numero;
    private $sexe;
    private $photo_profil;
    private $description;
    private $localisation ;
    private $dnaissance;

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

    public function __construct($nom, $prenom, $email, $password, $numero, $sexe ,$photo_profil,$description,$localisation,$dnaissance) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->numero = $numero;
        $this->sexe = $sexe;
        $this->photo_profil = $photo_profil;
        $this->description= $description;
        $this->localisation= $localisation;
        $this->dnaissance = $dnaissance;
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire): Utilisateur {
        $mdpHache = MotDePasse::hacher($tableauFormulaire["password"]);
        return new Utilisateur($tableauFormulaire["nom"], $tableauFormulaire["prenom"], $tableauFormulaire["email"], 
                                $mdpHache,$tableauFormulaire["numero"],$tableauFormulaire["sexe"],
                                $tableauFormulaire["photo_profil"],$tableauFormulaire["description"],
                                $tableauFormulaire["localisation"],$tableauFormulaire["dnaissance"]);
    }

}

?>