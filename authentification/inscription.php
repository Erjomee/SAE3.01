<?php  
    $name = $_POST["nom"] ; 
    $surname = $_POST["prenom"] ; 
    $email = $_POST["email"] ; 
    $password = $_POST["password"] ;    
    include("connectBD.php");
    try {
        $pdo ->beginTransaction();
        
        $stmt = $pdo->prepare('INSERT INTO utilisateur(nom, prenom,email,password) VALUES (:nom , :prenom , :email , :password)');
        $stmt->execute([
            ':nom' => $name,
            ':prenom' => $surname,
            ':email' => $email,
            ':password' => $password
        ]);

        $stmt->execute();
        $stmt->commit();

        echo "transac réussis";

    } catch (Exeption $e) {
        // En cas d'erreur, annulez la transaction
        $pdo->rollBack();
        echo 'Erreur : ' . $e->getMessage();
    }
?>