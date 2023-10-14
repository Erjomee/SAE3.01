

<div class="container">

<!--    <div id="filtre">-->
<!--        <h4>-->
<!--            Affinez votre choix-->
<!--        </h4>-->
<!--        <h5>Recherche par:</h5>-->
<!--        <form method="get">-->
<!--            <ul>-->
<!--                <li><input type="radio" name="filtre_f" value="id_espece">ID espece</li>-->
<!--                <li><input type="radio" name="filtre_f" value="vernacular_name" checked>Nom vernaculaire</li>-->
<!--                <li><input type="radio" name="filtre_f" value="scientific_name">Nom scientifique</li>-->
<!--            </ul>-->
<!--        </form>-->
<!--    </div>-->

    <div class="search">
        <h1>
            ESPECES
        </h1>

        <form id="rechercheForm"  method="get" >
            <nav class="nav_recherche">
                <input type="search" id="marecherche" name="recherche" placeholder="Nom vernaculaire | ex: Pinson familier">
                <button type="submit">Rechercher</button>
                <span class="validity"></span>
            </nav>
            <div id="filtre">
                <h4>
                    Affinez votre choix
                </h4>
                <h5>Recherche par:</h5>
                    <ul>
                        <li><input id="radio1" type="radio" name="filtre_f" value="id_espece">ID espece</li>
                        <li><input id="radio2" type="radio" name="filtre_f" value="vernacular_name" checked>Nom vernaculaire</li>
                        <li><input id="radio3" type="radio" name="filtre_f" value="scientific_name">Nom scientifique</li>
                    </ul>
            </div>
        </form>

        <hr>
        <h3>
            Résultat de la recherche :
        </h3>
        <div class="historique">
            <!--   à automatiser avec php (mettre les images)         -->
            <div class="item">
                Item 1
            </div>
            <div class="item">
                Item 2
            </div>
            <div class="item">
                Item 3
            </div>
            <div class="item">
                Item 4
            </div>
            <div class="item">
                Item 5
            </div>

            <div class="item">
                Item 6
            </div>
            <div class="item">
                Item 7
            </div>
            <div class="item">
                Item 8
            </div>
            <div class="item">
                Item 9
            </div>
            <div class="item">
                Item 10
            </div>
        </div>
    </div>
</div>
