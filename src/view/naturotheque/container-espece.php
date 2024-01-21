<div class="tab-container">
        <div class="tab" onclick="selectTab('enregistre', '<?php echo $email ?>')">Enregistré</div>
        <div class="tab" onclick="selectTab('aime', '<?php echo $email ?>')">Aimé</div>
    </div>

    
<div class="grille">

</div>


<input type="text" id="radio1" hidden>
<input type="text" id="radio2" hidden>
<input type="text" id="radio3" hidden>
<input type="text" id="marecherche" hidden>




<div id="popup">
    <div id="popupInfo">
        <div id="hidden" hidden>
            <span id="closePopup">&times;</span>
            <div id="popupHeader">
                <?php include("./../src/view/espece/en_tete.html")?>
            </div>

            <!--         ONGLET           -->
            <div id="onglet">
                <ul id="lst_onglet">
                    <li id="onglet1" class="active" onclick="activeOnglet('onglet1')">Description</li>
                    <li id="onglet2" onclick="activeOnglet('onglet2')"> Fiche taxon</li>
                    <li id="onglet3" onclick="activeOnglet('onglet3')">Interraction</li>
                    <li id="onglet4" onclick="activeOnglet('onglet4')">Observation</li>
                </ul>
            </div>
            <!--         DESCRIPTION           -->
            <div id="description">
                <?php include("./../src/view/espece/description.html")?>
            </div>
            <!--         FICHE TAXON           -->
            <div id="taxon" hidden>
                <?php include("./../src/view/espece/fiche_taxon.html")?>
            </div>
            <!--         Interraction           -->
            <div id="interraction" hidden>
                <?php include("./../src/view/espece/interraction.html")?>
            </div>
            <!--         OBSERVATION           -->
            <div id="observation" hidden>
                <?php include("./../src/view/espece/observation.html")?>
                
            </div>

        </div>
    </div>
</div>



