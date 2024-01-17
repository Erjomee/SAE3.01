<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Changez votre mot de passe</title>
</head>

<body>
  <div class="page-container">
    <h2>Changez votre mot de passe</h2>
    <form>
      <div class="form-group">
        <label for="current_password">Mot de passe actuel<span>*</span></label>
        <div class="input-background">
          <input name="current_password" type="password" class="input" required="" value="">
        </div>
        <p></p>
      </div>

      <div class="form-group">
        <label for="new_password">Nouveau mot de passe<span>*</span></label>
        <div class="input-background">
          <input name="new_password" type="password" class="input" required="" value="">
        </div>
        <p></p>
      </div>
      <div class="form-group">
        <label for="new_password">Confirmer le mot de passe<span>*</span></label>
        <div class="input-background">
          <input name="new_password" type="password" class="input" required="" value="">
        </div>
        <p></p>
      </div>

      <div class="button-container">
        <a href="/fr-fr/edit-profile/" class="cancel-link">
          <p>Annuler</p>
        </a>
        <button type="submit" disabled="" class="submit-button">
          <span>Changer le mot de passe</span>
        </button>
      </div>
    </form>
  </div>
</body>

</html>
