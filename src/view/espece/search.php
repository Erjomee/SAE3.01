

<div class="container">

    <div class="search">
        <h1>
            ESPECES
        </h1>

        <form id="rechercheForm"  onsubmit="event.preventDefault(); rechercher(1)">
            <nav class="nav_recherche">
                <input type="hidden"  name="controller" value="espece">
                <input type="hidden"  name="action" value="searchBy">
                <input type="search" id="marecherche" name="recherche" placeholder="Nom vernaculaire | ex: Pinson familier" required>

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
                <div >
                    <!-- Filtre habitat -->
                    <label for="habitats-select">Habitat:</label>
                    <select name="habitats" id="habitats-select" style="width: 100%;">
                        <option value="0">--Tous--</option>
                        <option value="1">Marin</option>
                        <option value="2">Eau douce</option>
                        <option value="3">Terrestre</option>
                        <option value="4">Marin et eau douce</option>
                        <option value="5">Marin et terrestre</option>
                        <option value="6">Eau saumâtre</option>
                        <option value="7">Continental (terrestre et/ou eau douce)</option>
                        <option value="8">Continental (terrestre et eau douce)</option>
                    </select>

                    <!-- Filtre rang taxonomique -->
                    <label for="taxonomicRanks-select">Rang taxonomique:</label>
                    <select name="taxonomicRanks" id="rang-select" style="width: 100%;">
                        <option value="0">--Tous--</option>
                        <option value="Dumm">Domaine</option>
                        <option value="KD">Règne</option>
                        <option value="PH">Phylum</option>
                        <option value="CL">Classe</option>
                        <option value="OR">Ordre</option>
                        <option value="FM">Famille</option>
                        <option value="SBFM">Sous-Famille</option>
                        <option value="TR">Tribu</option>
                        <option value="GN">Genre</option>
                        <option value="AGES">Agrégat</option>
                        <option value="ES">Espèce</option>
                        <option value="SSES">Sous-Espèce</option>
                        <option value="NAT">Natio</option>
                        <option value="VAR">Variété</option>
                        <option value="SVAR">Sous-Variété</option>
                        <option value="FO">Forme</option>
                        <option value="SSFO">Sous-Forme</option>
                        <option value="RACE">Race</option>
                        <option value="CAR">Cultivar</option>
                        <option value="AB">Abberatio</option>
                    </select>


                    <!-- Filtre territoires -->
                    <label for="territories-select">Territoires:</label>
                    <select name="territories" id="territories-select" style="width: 100%;">
                        <option value="0">--Tous--</option>
                        <option value="fr">France métropolitaine</option>
                        <option value="gf">Guyane française</option>
                        <option value="gua">Guadeloupe</option>
                        <option value="mar">Martinique</option>
                        <option value="sm">Saint-Martin</option>
                        <option value="sb">Saint-Barthélemy</option>
                        <option value="spm">Saint-Pierre-et-Miquelon</option>
                        <option value="epa">Îles éparses</option>
                        <option value="may">Mayotte</option>
                        <option value="reu">Réunion</option>
                        <option value="sa">Îles subantarctiques</option>
                        <option value="ta">Terre Adélie</option>
                        <option value="nc">Nouvelle-Calédonie</option>
                        <option value="wf">Wallis et Futuna</option>
                        <option value="pf">Polynésie française</option>
                        <option value="cli">Clipperton</option>
                    </select>

                    <!-- Filtre territoires -->
                    <label for="domain-select">Domaine:</label>
                    <select name="domain" id="domain-select" style="width: 100%;">
                        <option value="0">--Tous--</option>
                        <option value="marin">Marin</option>
                        <option value="continental">Continental</option>
                    </select>
                </div>

                <h5>Image uniquemet:</h5>
                <input type="checkbox" name="image" id="image-checkbox">
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
