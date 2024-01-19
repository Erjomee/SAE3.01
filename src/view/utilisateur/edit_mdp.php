
<div class="page-container">
    <h2>Changez votre mot de passe</h2>
    <form method="GET">
      <div class="form-group">
        <label for="current_password">Mot de passe actuel<span>*</span></label>
        <div class="input-background">
          <input name="ancient_password" type="password" class="input" required="" value="">
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
          <input name="confirm_new_password" type="password" class="input" required="" value="">
        </div>
        <p></p>
      </div>

      <input name="controller" value="utilisateur" hidden>
      <input name="action" value="change_mdp" hidden>


      <div class="button-container">
        <a href="/fr-fr/edit-profile/" class="cancel-link">
          <p>Annuler</p>
        </a>
        <button type="submit" class="submit-button">
          <span>Changer le mot de passe</span>
        </button>
      </div>
    </form>
</div>
