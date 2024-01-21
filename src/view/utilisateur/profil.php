<div class="container">
        <div class="avatar" style="background-image: url('./../assets/img/img_profil/<?php echo $photo_profil?>');">
        </div>
        <h1 class="username" ><?php echo $first_name. ' ' .$last_name?></h1>
        <a class="edit-profile" href="frontController.php?controller=utilisateur&action=edit_profil">Modifier le profil</a>
        <div class="stats-grid">
            <div class="stat">
                <div class="stat-content">
                    <p class="stat-label">Nombre de vues totals</p>
                    <h4 class="stat-value" title="0"><?php echo $nbr_vue?></h4>
                </div>
            </div>
            <div class="stat">
                <div class="stat-content">
                    <p class="stat-label">Nombre d'espèce aimés</p>
                    <h4 class="stat-value" title="576,7 millier"><?php echo $nbr_like?></h4>
                </div>
            </div>
            <div class="stat">
                <div class="stat-content">
                    <p class="stat-label">Nombre d'espèce enregistrés</p>
                        <h4 class="stat-value" title="19 millier"><?php echo $nbr_save?></h4>
                </div>
            </div> 
        </div>
    </div>
