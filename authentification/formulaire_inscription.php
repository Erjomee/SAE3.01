<?php 
    session_start();
?>
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
<form method="POST">
    <fieldset>
        <legend>Inscription</legend>
        <p>
            <label for="nom">Nom*:</label>
            <input type="text" id="nom_id" name="nom" placeholder="Dupont" required>
        </p>
        <p>
            <label for="prenom">Pénom*:</label>
            <input type="text" id="prenom_id" name="prenom" placeholder="Jean" required>
        </p>
        <p>
            <label for="email">Email*:</label>
            <input type="email" id="email_id" name="email" placeholder="jean.dupont@gmail.com" required>
        </p>
        <p>
            <label for="prenom">Mot de passe*:</label>
            <input type="password" id="password_id" name="password" placeholder="mdp123" required>
        </p>
        <p>
            <label for="prenom">Numéro:</label>
            <input type="tel" id="numero_id" name="numero" placeholder="0629701938">
        </p>
        <p>
            <label for="prenom">Sexe:</label>
            <input type="radio" name="sexe" value="M">Homme
            <input type="radio" name="sexe" value="F">Femme
        </p>

        <p style="display: none;" id="error">Utilisateur déjà existant</p>
    
        <input type="submit" name="submit_btn" value="Soumettre">
    </fieldset>
</form>

<?php 
    // Récupération des information du formulaire
    if (isset($_POST['submit_btn'])) { 
        // Connection à la base de donnée
        include("connectBD.php");
        try {

            $utilisateur = array(
                "nom" => $_POST["nom"] ,
                "prenom" => $_POST["prenom"],
                "email" => $_POST["email"],
                "password" => $_POST["password"]
            );

            $sql = "Select * from utilisateur where email = '$utilisateur[email]'";
            $reponse = $pdo->query($sql);
            // Si l'utilisateur n'est pas encore inscrit
            if ($reponse->rowCount() == 0) {

                $columns = "nom,prenom,email,password";
                $values = ":nom,:prenom,:email,:password";

                $dico_value = [
                    ':nom' => $utilisateur["nom"],
                    ':prenom' => $utilisateur["prenom"],
                    ':email' => $utilisateur["email"],
                    ':password' => $utilisateur["password"]
                ];

                if (isset($_POST['numero'])) {
                    $utilisateur["numero"] = $_POST["numero"];
                    $columns .= ",numero";
                    $values .= ",:numero";
                    $dico_value["numero"] = $utilisateur["numero"];
                }
                if (isset($_POST['sexe'])) {
                    $utilisateur["sexe"] = $_POST["sexe"];
                    $columns .= ",sexe";
                    $values .= ",:sexe";
                    $dico_value["sexe"] = $utilisateur["sexe"];

                }
                $pdo ->beginTransaction();
                
                $stmt = $pdo->prepare("INSERT INTO utilisateur($columns) VALUES ($values)");
                $stmt->execute($dico_value);

                $pdo->commit();
                
                $_SESSION['user'] = $utilisateur["nom"];
                header('Location: http://127.0.0.1/SAE3.01/');
                

            // Si l'utilisateur existe déjà dans la base donnée
            }else {
                echo "
                <script> 
                    document.getElementById('error').style.display = 'block';
                    document.getElementById('error').style.color = 'red';
                </script> ";
            }
            
        } catch (Exception $e) {
            // En cas d'erreur, annulez la transaction
            $pdo->rollBack();
            echo 'Erreur : ' . $e->getMessage();
        }
    }
?>
    
</body>
</html>
