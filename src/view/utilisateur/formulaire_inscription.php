<form id="inscription-id"  method="GET" action="frontController.php?">
    <fieldset>
    <h1>Formulaire d'inscription</h1>
        <ul>

                <label for="nom">Nom:</label>
                <input type="text" id="nom_id" name="nom" placeholder="Dupont" >

                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom_id" name="prenom" placeholder="Jean" >

                <label for="email">Email:</label>
                <input type="email" id="email_id" name="email" placeholder="jean.dupont@gmail.com" >

                <label for="prenom">Mot de passe:</label>
                <input type="password" id="password_id" name="password" placeholder="mdp123" >

                <label for="prenom">Vérification du mot de passe*:</label>
                <input type="password" id="password_id" name="password2" placeholder="mdp123" >

        </ul>
        <div> 
            <a href="formulaire_connexion.php">Déjà inscrit ?</a>
        </div>


        <input type="hidden" name="controller" value="utilisateur">
        <input type="hidden" name="action" value="registered">

        <input type="submit" id="submit_id" name="submit_btn" value="Soumettre">
    </fieldset>
</form>