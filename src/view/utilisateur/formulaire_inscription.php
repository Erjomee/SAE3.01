<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Page d'inscription</title>
</head>
<?php include("assets/php/nav.php"); ?>
<body>


<h1>Formulaire d'inscription</h1>
<form id="inscription-id"  method="POST">
    <fieldset>
        <legend>Inscription</legend>
        <ul>
            <li>
                <label for="nom">Nom*:</label>
                <input type="text" id="nom_id" name="nom" placeholder="Dupont" required>
            </li>
            <li>
                <label for="prenom">Pénom*:</label>
                <input type="text" id="prenom_id" name="prenom" placeholder="Jean" required>
            </li>
            <li>
                <label for="email">Email*:</label>
                <input type="email" id="email_id" name="email" placeholder="jean.dupont@gmail.com" required>
            </li>
            <li>
                <label for="prenom">Mot de passe*:</label>
                <input type="password" id="password_id" name="password" placeholder="mdp123" required>
            </li>
            <li>
                <label for="prenom">Numéro:</label>
                <input type="tel" id="numero_id" name="numero" placeholder="0629701938">
            </li>
            <li>
                <label for="prenom">Sexe:</label>
                <input type="radio" name="sexe" value="M">Homme 
                <input type="radio" name="sexe" value="F">Femme
            </li>

        </ul>
        <div> 
            <a href="formulaire_connexion.php">Déjà inscrit ?</a>
        </div>
        <div style="display: none;" id="error"></div>
    
        <input type="submit" id="submit_id" name="submit_btn" value="Soumettre">
    </fieldset>
</form>



<?php 
    // Récupération des information du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        // Connection à la base de donnée
        include("assets/php/connectBD.php");
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

                // Information obligatoire
                $columns = "nom,prenom,email,password";
                $values = "?,?,?,?";
                $data = [$utilisateur["nom"], $utilisateur["prenom"], $utilisateur["email"], $utilisateur["password"]];

                // Verifiaction des informations supplémentaires fournie
                if (isset($_POST['numero'])) {
                    $utilisateur["numero"] = $_POST["numero"];
                    $data[] = $utilisateur["numero"];
                    $columns .= ",numero";
                    $values .= ",?";
                }
                if (isset($_POST['sexe'])) {
                    $utilisateur["sexe"] = $_POST["sexe"];
                    $data[] = $utilisateur["sexe"];
                    $columns .= ",sexe";
                    $values .= ",?";
                }

                // TRANSACTION (insertion dans la bd)
                $pdo ->beginTransaction();
                $stmt = $pdo->prepare("INSERT INTO utilisateur($columns) VALUES ($values)");
                $stmt->execute($data);
                $pdo->commit();

                // Session utilisateur
                $_SESSION['user'] = $utilisateur;
                header('Location: index.php');
                
            // Si l'utilisateur existe déjà dans la base donnée
            }else {
                echo "
                <script> 
                    document.getElementById('error').style.display = 'block';
                    document.getElementById('error').innerHTML= 'utilisateur déjà existant';
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

<script src="../../assets/js/script.js"></script>
</body>
</html>
