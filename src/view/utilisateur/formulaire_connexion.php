
<form method="post" >
    <h3>C'est un plaisir de vous revoir !</h3>
    <fieldset>
        <!-- <legend>C'est un plaisir de vous revoir !</legend> -->
        <p>
            <label for="email">Email</label>
            <input type="email" id="email_id" name="email" placeholder="jean.dupont@gmail.com" >
        </p>
        <p>
            <label for="password">Mot de passe</label>
            <input type="password" id="password_id" name="password" placeholder="mdp123" >
        </p>
        <input id="action" name="action" value="connecter" hidden>

        <input type="submit" value="Connexion" name="Envoi">
    </fieldset>
</form>
