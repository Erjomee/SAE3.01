<?php  

    $name = $_POST["nom"] ; 
    $surname = $_POST["prenom"] ; 
    $email = $_POST["email"] ; 
    $password = $_POST["password"] ;    
    include("connectBD.php");
    try {
        $stmt = $pdo->prepare('SELECT * FROM utilisateur');
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo 'Nom: ' . $row['nom'] . ', Prenom: ' . $row['prenom'] . ', Email: ' . $row['email'] . $row['numero'].'<br>';
            }

        
    } catch (Exeption $e) {
        // En cas d'erreur, annulez la transaction
        $pdo->rollBack();
        echo 'Erreur : ' . $e->getMessage();
    }
?>