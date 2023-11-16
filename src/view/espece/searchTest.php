

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


        <div id="default_message"><h1>Veuillez saisir une recherche</h1></div>
        <div id="resultat"></div>


    </div>
</div>
