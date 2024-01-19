<div class="page-container">
  <div class="tab-container">
    <a href="/fr-fr/edit-profile/" class="active">Profil</a>
  </div>
  
  <h2>Paramètres de profil</h2>
  
  <div class="avatar-section">
    <div class="avatar">
      <!-- <img src="https://images.pexels.com/users/avatars/907968517/marius-mbl91-994.jpg?auto=compress&fit=crop&h=130&w=130&dpr=1" alt="marius. mbl91" id="previewImage"> -->
      <img src="./../assets/img/img_profil/<?php echo $photo_profil?>"  alt="marius. mbl91" id="previewImage">
    </div>
    <label for="changeImage" class="avatar-button">
    <form action="" id="myForm" method="post" enctype="multipart/form-data">
      <input name="controller" value="utilisateur" hidden>
      <input name="action" value="change_image" hidden>
      <input type="file" id="changeImage" name="images" accept="image/jpg, image/jpeg, image/png" onchange="submitForm()">
      <!-- <input type="submit" name="validate"> -->
    </form>
    </label>
  </div>
  
  <form method="GET">
    <div class="form-group">
      <label for="first_name">Prénom<span>*</span></label>
      <input type="text" id="first_name" name="first_name" required value=<?php if (isset($first_name)) {echo $first_name;}?>>
    </div>

    <div class="form-group">
      <label for="last_name">Nom de famille<span>*</span></label>
      <input type="text" id="last_name" name="last_name" required value=<?php if (isset($last_name)) {echo $last_name;}?>>
    </div>

    <div class="form-group">
      <label for="email">E-mail<span>*</span></label>
      <input type="email" id="email" name="email" required value=<?php if (isset($email)) {echo $email;}?>>
    </div>

    <div class="form-group">
      <label for="date_of_birth">Date de naissance</label>
      <input type="date" id="date_of_birth" name="date_of_birth" value=<?php if (isset($date_of_birth)) {echo $date_of_birth;}?>>
    </div>

    <div class="form-group">
      <label for="bio">A propos</label>
      <textarea id="bio" name="bio" rows="4" placeholder="Ajouter votre biographie"><?php if (isset($bio)) {echo $bio;}?></textarea>
    </div>

    <div class="form-group">
      <label for="location">Emplacement</label>
      <input type="text" id="location" name="location" placeholder="Paris" value=<?php if (isset($location)) {echo $location;}?> >
    </div>

    <div class="form-group">
      <label for="change_password">Mot de passe</label>
      <a href="frontController.php?controller=utilisateur&action=edit_mdp"><button type="button">Changer le mot de passe</button></a>
    </div>

    <div class="form-group">
      <label for="phone_number">Numéro de téléphone</label>
      <input type="tel" id="phone_number" name="phone_number" value=<?php if (isset($phone_number)) {echo $phone_number;}?>>
    </div>


    <div class="form-group">
      <label for="delete_account">Supprimer le compte et toutes ses données</label>
      <button type="button">Supprimer mon compte</button>
    </div>

    <input name="controller" value="utilisateur" hidden>
    <input name="action" value="change_profil" hidden>

    <div class="form-group">
      <button type="submit">Enregistrer le profil</button>
    </div>
  </form>
</div>
