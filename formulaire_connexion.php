<?php
    session_start();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<form action="" method="post" align="center">
        <h1>Formulaire de connexion</h1>
        <fieldset>
            <legend>Connexion</legend>
            <p>
                <label for="email">Email</label>
                <input type="email" id="email_id" name="email" placeholder="jean.dupont@gmail.com" >
            </p>
            <p>
                <label for="password">Mot de passe</label>
                <input type="password" id="password_id" name="password" placeholder="mdp123" >
            </p>
            <input type="submit" value="Envoyer" name="Envoi">
        </fieldset>
    </form>

<?php
if(isset($_POST['Envoi'])) {
    try {
        session_start();
        $bdd = new PDO('mysql:host=localhost;dbname=sae', 'root', 'root');

        if(!$bdd) {
            echo "Erreur de connexion à la base de données.";
        }

        if (!empty($_POST['email']) AND !empty($_POST['password'])){
            // Récupérer les données du formulaire
            $email = $_POST["email"];
            $password = $_POST["password"];
          

            $querry = $bdd->prepare("select * from utilisateur where email = ? and password = ? ");
            $querry->execute(array($email,$password));

            // Récupérer le résultat
            $user = $querry->fetch(PDO::FETCH_ASSOC);

            if($querry->rowCount() > 0){
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                $_SESSION["nom"] = $user["nom"];
                $_SESSION["prenom"] = $user["prenom"];
                $_SESSION["id_utilisateur"] = $user["id_utilisateur"];


                

            }
            else{
                echo "Votre mot de pass ou le mail est incorrect";
            }
        }
        else{
            echo "veuillez rentrez tout les champs";
        }
        
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

</body>
</html>
