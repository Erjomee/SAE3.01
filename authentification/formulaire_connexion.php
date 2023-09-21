<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire de connexion</h1>
    <fieldset>
        <legend>Connexion</legend>
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
</body>
</html>