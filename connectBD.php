<?php   

    try {
        // Connexion à la base de données MySQL
        $pdo = new PDO('mysql:host=localhost;dbname=sae301', 'root', '');
        // Définir le mode d'erreur PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connexion établie";

    }catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
?>