<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<h1>Formulaire d'inscription</h1>
<form action="inscription.php" method="post">
    <fieldset>
        <legend>Inscription</legend>
        <p>
            <label for="nom">Nom</label>
            <input type="text" id="nom_id" name="nom" placeholder="Dupont" required>
        </p>
        <p>
            <label for="prenom">Pénom</label>
            <input type="text" id="prenom_id" name="prenom" placeholder="Jean" required>
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email" id="email_id" name="email" placeholder="jean.dupont@gmail.com" required>
        </p>
        <p>
            <label for="prenom">Mot de passe</label>
            <input type="password" id="password_id" name="password" placeholder="mdp123" required>
        </p>

        <p style="display: none;" id="error">Utilisateur déjà existant</p>
    
            <input type="submit" value="Envoyer">
    </fieldset>
</form>

<?php 
    // Récupération des information du formulaire
    $name = $_POST["nom"] ; 
    $surname = $_POST["prenom"] ; 
    $email = $_POST["email"] ; 
    $password = $_POST["password"] ;    
    // Connection à la base de donnée
    include("connectBD.php");
    try {
        $sql = "Select * from utilisateur where email = '$email'";
        $reponse = $pdo->query($sql);

        // Si l'utilisateur n'est pas encore inscrit
        if ($reponse->rowCount() == 0) {
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
        // Si l'utilisateur existe déjà dans la base donnée
        }else {
            echo "
            <script> 
            document.getElementById('error').style.display = 'block';
            document.getElementById('error').style.color = 'red';
            ";
        }
        // if ($_SERVER['REQUEST_ METHOD'] === 'POST'){

            // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //     echo 'Nom: ' . $row['nom'] . ', Prenom: ' . $row['prenom'] . ', Email: ' . $row['email'] . $row['numero'].'<br>';
            //     }
        // }    
    } catch (Exeption $e) {
        // En cas d'erreur, annulez la transaction
        $pdo->rollBack();
        echo 'Erreur : ' . $e->getMessage();
    }
?>


    
</body>
</html>
