

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
                        <li><input id="radio1" type="radio" name="filtre_f" value="taxrefIds" checked>ID espece</li>
                        <li><input id="radio2" type="radio" name="filtre_f" value="frenchVernacularNames" >Nom vernaculaire</li>
                        <li><input id="radio3" type="radio" name="filtre_f" value="scientificNames">Nom scientifique</li>
                    </ul>
                <div class="page_preference">
                    <h5>Page : <input type="number" name="page" value="1" step="1"></h5>
                    <h5>Size : <input type="number" name="size" value="9" step="1"></h5>
                </div>
                <!--      Faire un filtre déroulant          -->
                <h5>Filtre par:</h5>

            </div>
        </form>

        <hr>
        <?php
            // Texte par défault
            if (isset($default)) {
                echo "<h1>$default</h1>";
            }else{
                echo "<h3> Résultat de la recherche:</h3>";
                // Réponse invalide
                if (!isset($data)){
                    echo "<h1>Espece introuvable</h1>";
                }
            }
        ?>
        <div class="resultat">
            <!--   à automatiser avec php (mettre les images)         -->
<!--            <div class="item">-->
<!--                Item 1-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                Item 2-->
<!--            </div>-->
            <?php
                // Recherche saisie avec une réponse valide
                if (isset($data)) {
                    foreach ($data as $espece) {
                        if (isset($espece["_links"]["media"])){
                            $image = $espece["_links"]["media"][0];
                        }else{
                            $image = 'https://taxref.mnhn.fr/api/media/download/inpn/387409';
                        }

                        echo "<div class='item'>
                                <img class='img-carte' src={$image}></img>
                                <div class='information'>
                                    <p class='nom-espece'>{$espece['frenchVernacularName']}</p>
                                    <hr>
                                    <p>{$espece['fullNameHtml']}</p>
                                    <p>ID:{$espece['id']}</p>
                                </div>
                            </div>";
//                        var_dump($espece['_links']['media']);
                    }
                }
            ?>
        </div>
    </div>
</div>
