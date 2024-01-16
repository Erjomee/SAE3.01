

<div class="container">

    <div class="search">
        <h1>
            ESPECES
        </h1>

        <form id="rechercheForm"  onsubmit="event.preventDefault(); rechercher(1)">
            <nav class="nav_recherche">
                <input type="hidden"  name="controller" value="espece">
                <input type="hidden"  name="action" value="searchBy">
                <input type="search" id="marecherche" name="recherche" placeholder="ID | ex: 442365" required>

                <button type="submit">Rechercher</button>
                <span class="validity"></span>
            </nav>
            <div id="filtre">
                <h4>
                    Affinez votre choix
                </h4>
                
                <h5>Recherche par:</h5>
                <ul>
                    <li><input id="radio1" type="radio" name="filtre_f" value="taxrefIds" >ID espece</li>
                    <li><input id="radio2" type="radio" name="filtre_f" value="frenchVernacularNames" checked >Nom vernaculaire</li>
                    <li><input id="radio3" type="radio" name="filtre_f" value="scientificNames">Nom scientifique</li>
                </ul>
                <div class="page_preference">
                    <h5>Page : <input type="number" id="page" value="1" step="1"></h5>
                    <h5>Size : <input type="number" id="size" value="12" step="1"></h5>
                </div>
                <!--      Faire un filtre déroulant          -->
                <h5>Filtre par:</h5>


            </div>
        </form>

        <hr>

        <!--  Utilisation de script    -->
        <div id="result_area">
            <div id="default_message"><h1>Veuillez saisir une recherche</h1></div>
            <div id="resultat"></div>
        </div>
        <div id="pagination_content">
            <ul id="pagination"></ul>
        </div>


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

    </div>
</div>
