<h1>Ma naturautheque</h1>

<input id="utilisateur" value="<?php echo $user_login ?>" hidden>

<div class="tab-container">
    <div class="tab" onclick="selectTab('enregistre', '<?php echo $user_login ?>')">Enregistré</div>
    <div class="tab" onclick="selectTab('aime', '<?php echo $user_login ?>')">Aimé</div>
</div>
    
<div class="grille">
    <div class="grid-items"></div>
</div>
