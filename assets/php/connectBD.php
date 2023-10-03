<?php   
    try {
        // Connexion à la base de données MySQL
        $pdo = new PDO('mysql:host=localhost;dbname=sae301', 'root', 'root ');
        // Définir le mode d'erreur PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
?>