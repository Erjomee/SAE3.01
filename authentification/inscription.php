<?php  
    if req
    $name = $_POST["nom"] ; 
    $surname = $_POST["prenom"] ; 
    $email = $_POST["email"] ; 
    $password = $_POST["password"] ;    
    include("connectBD.php");
    try {

        if ($_SERVER['REQUEST_ METHOD'] == 'POST'){
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

            echo "transac réussis"

            // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //     echo 'Nom: ' . $row['nom'] . ', Prenom: ' . $row['prenom'] . ', Email: ' . $row['email'] . $row['numero'].'<br>';
            //     }
        }    
    } catch (Exeption $e) {
        // En cas d'erreur, annulez la transaction
        $pdo->rollBack();
        echo 'Erreur : ' . $e->getMessage();
    }
?>