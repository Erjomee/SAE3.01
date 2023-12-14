

<div class="container">

    <div class="search">
        <h1>
            ESPECES
        </h1>

        <form id="rechercheForm"  onsubmit="event.preventDefault(); rechercher()">
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
                    <h5>Size : <input type="number" id="size" value="9" step="1"></h5>
                </div>
                <!--      Faire un filtre déroulant          -->
                <h5>Filtre par:</h5>

            </div>
        </form>

        <hr>

        <!--  Utilisation de script      -->
        <div id="default_message"><h1>Veuillez saisir une recherche</h1></div>
        <div id="resultat"></div>

        <div id="popup">
            <div id="popupInfo">
                <span id="closePopup">&times;</span>


                <div style="display: flex ; align-items: center">
                    <!--      Coin supérieur gauche          -->
                    <div id="slider" class="slider"></div>

                    <!--         Titre           -->
                    <div id="en-tete">
                        <h2 id="first_title"></h2>
                        <hr>
                        <p id="second_title" ></p>
                    </div>

                </div>


                <!--         Main           -->
                <div style="display: flex; flex-wrap: wrap;margin-top: 20px">

                    <!--        Bloc de gauche           -->
                    <div id="habitat-statut" >
                        <div id="habitat">
                            <h2>Habitat</h2>
                            iaozfhoizhfozahofhzahfizahoif
                            <br>
                            azfpaziofzaiof
                        </div>

                        <div id="statut" >
                            <h2>Statut Géographique</h2>
                            iaozfhoizhfozahofhzahfizahoif
                            <br>
                            azfpaziofzaiof
                        </div>
                    </div>

                    <!--        Bloc de droite           -->
                    <div id="rang">
                        <h2>Rang taxinomique</h2>
                        iaozfhoizhfozahofhzahfizahoif
                        <br>
                        azfpaziofzaiof
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
