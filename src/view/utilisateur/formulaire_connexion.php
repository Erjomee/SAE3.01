
<form method="post" >
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
        <input id="action" name="action" value="connecter" hidden>

        <input type="submit" value="Envoyer" name="Envoi">
    </fieldset>
</form>
