

<div class="container">

    <div class="search">
        <h1>
            ESPECES
        </h1>

        <form id="rechercheForm"  onsubmit="event.preventDefault(); rechercher(1)">
            <nav class="nav_recherche">
                <input type="hidden"  name="controller" value="espece">
                <input type="hidden"  name="action" value="searchBy">
                <div class="search-container">
                    <input type="search" id="marecherche" name="recherche" placeholder="Nom vernaculaire | ex: Pinson familier" required>
                    <span class="search-icon"><i class="fas fa-search"></i></span>
                </div>
                <button type="submit">Rechercher</button>
                <i id="icon-filtre" class='bx bxs-chevron-up' onclick="toggle_filters()"></i>
                
                <span class="validity"></span>
            </nav>
 
            <div id="filtre" class="display" hidden>
                <h3>
                    Affinez vos choix
                </h3>
                
                <h4>Recherche par:</h4>
                <ul id="filtreList">
                    <li><input id="radio1" type="radio" name="filtre_f" value="frenchVernacularNames" checked><label style="background-color: #26B2A2;color: white" for="radio1">Nom vernaculaire</label></li>
                    <li><input id="radio2" type="radio" name="filtre_f" value="taxrefIds" ><label for="radio2">ID espece</label></li>
                    <li><input id="radio3" type="radio" name="filtre_f" value="scientificNames"><label for="radio3">Nom scientifique</label></li>
                </ul>
                <!--      Faire un filtre déroulant          -->
                <h4>Filtre par:</h4>
                <div class="filtres">
                <div class="div_filtre1">
                    <!-- Filtre habitat -->
                    <div class="div_filtre">
                    <label for="habitats-select">Habitat:</label>
                    <select name="habitats" id="habitats-select">
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
                    </div>

                    <!-- Filtre rang taxonomique -->
                    <div class ="div_filtre">
                    <label for="taxonomicRanks-select">Rang taxonomique:</label>
                    <select name="taxonomicRanks" id="rang-select" >
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
                    </div>
                </div>


                    <div class="div_filtre2">
                    <!-- Filtre territoires -->
                    <div class = "div_filtre">
                    <label for="territories-select">Territoires:</label>
                    <select name="territories" id="territories-select" >
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
                    </div>

                    <!-- Filtre territoires -->
                    <div class = "div_filtre">
                    <label for="domain-select">Domaine:</label>
                    <select name="domain" id="domain-select">
                        <option value="0">--Tous--</option>
                        <option value="marin">Marin</option>
                        <option value="continental">Continental</option>
                    </select>
                    </div>
                
                </div>
                </div>

                <div class="filtres">
                    <div >
                        <h4>Avec Image uniquement: <input type="checkbox" name="image" id="image-checkbox"></h4>
                    </div>

                    <h4>Page : <input type="number" id="page" value="1" step="1"></h4>
                    <h4>Size : <input type="number" id="size" value="12" step="1"></h4>
                </div>


            </div>
        </form>


        <!--  Utilisation de script    -->
        <div id="result_area">
            <div id="default_message"><h2>Veuillez saisir une recherche</h2></div>
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
