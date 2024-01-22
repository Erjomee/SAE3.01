<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
</head>

<!-- SLIDER -->
<div class="slider">
    <div id="test">
        <h2>Rechercher sur le site TaxonSphère</h2>
        <div id ="recherche">
            <input type="text" class="recherche" placeholder="Rechercher une espèce" />
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <h6> Apprenez en davantage sur les espèces fascinantes qui peuplent notre planète </h6>
    </div>
    <img src="../assets/img/test2.jpg" alt="img1" class="img__slider active" />
    <img src="../assets/img/ecureil.jpg" alt="img2" class="img__slider" />
    <img src="../assets/img/chevreuil.jpg" alt="img3" class="img__slider" />
    <img src="../assets/img/ours.jpg" alt="img4" class="img__slider" />
    <img src="../assets/img/renard2.jpeg" alt="img5" class="img__slider" />
    <img src="../assets/img/loup.jpg" alt="img6" class="img__slider" />

    <div class="suivant">
        <!-- <i class="fas fa-chevron-circle-right"></i>         -->
    </div>
    <div class="precedent">
        <!-- <i class="fas fa-chevron-circle-left"></i> -->
    </div>
</div>

<!-- Se connecter-->
<div class="div_connecter">
    <h3 class="first">
        <a href="http://frontController.php?controller=naturotheque&action=readAll">Accéder à ma Naturothèque </a>
    </h3>

    <div class="separation">
    </div>

    <h3 class="second">
        <a href="frontController.php?controller=utilisateur&action=register"> Vous n’êtes pas encore inscrit </a>
    </h3>
</div>

<div class="articles">
    <!--ARTICLE 1 - ESCARGOT -->
    <div class="div_article1">
        <!-- height="300" width="400" -->
        <img src="../assets/img/escargot.jpg"  height="300" width="400" alt="image_escargot" class="img_article">

        <div class="div_text1">

            <h2>"11 % des escargots sont menacés"</h2>
            <p>Dès que la pluie est là, ils pointent le bout de leurs antennes. Connus de tous, les escargots sont pourtant pleins de mystères.
                En France, 691 espèces sont recensées par l’Inventaire national du patrimoine naturel (INPN).
                Parmi elles, un tiers n’existe nulle part ailleurs dans le monde. Aucun doute : l’Hexagone est bien le pays du plus célèbre des mollusques terrestres.
                Et pourtant, on ne fait pas assez pour ces petites bêtes. L’INPN établit que 41 % des espèces, soit près de la moitié, sont trop mal connues en France pour que leur statut de conservation puisse être évalué.
                Pour contrecarrer ces données insuffisantes, vous pouvez agir. En avril 2023, le Muséum national d’Histoire naturelle a lancé une « opération escargots ».
                On vous explique de quoi il s’agit et comment vous pouvez contribuer.
            </p>

            <div id="div_button">
                <button onclick="togglePopup(1)">En savoir plus</button>
            </div>

            <div id="popup_art1">
                <div id="popup-content">
                    <h4>Escargots : dans votre jardin, vous pouvez aider les scientifiques à les sauver</h4>
                    <br>
                    <p>Un programme permettant aux citoyens de suivre les escargots dans leur jardin est lancé. Le but : faire avancer la science qui dispose de données insuffisantes sur l'espèce.</p>
                    <p>Dès que la pluie est là, ils pointent le bout de leurs antennes. Connus de tous, les escargots sont pourtant pleins de mystères. En France, 691 espèces sont recensées par l’Inventaire national du patrimoine naturel (INPN).
                        Parmi elles, un tiers n’existe nulle part ailleurs dans le monde. Aucun doute : l’Hexagone est bien le pays du plus célèbre des mollusques terrestres.
                        Et pourtant, on ne fait pas assez pour ces petites bêtes. L’INPN établit que 41 % des espèces, soit près de la moitié, sont trop mal connues en France pour que leur statut de conservation puisse être évalué.
                        Pour contrecarrer ces données insuffisantes, vous pouvez agir. En avril 2023, le Muséum national d’Histoire naturelle a lancé une « opération escargots ». On vous explique de quoi il s’agit et comment vous pouvez contribuer.
                    </p>
                    <br>
                    <h5>11 % des escargots sont menacés</h5>
                    <br>
                    <p>« Au total, 2 espèces ont déjà disparu, 79 sont menacées et 32 autres sont quasi menacées », précise l’Union internationale pour la conservation de la nature (UICN) dans un fascicule dédié aux mollusques continentaux.
                        Au niveau mondial, l’association de protection de la biodiversité a recensé davantage d’extinctions d’escargots que de mammifères, oiseaux, reptiles et amphibiens réunis.
                        Pollution agricole, piétinement dû à la surfréquentation de sites touristiques, surpâturage, feux de forêt de plus en plus fréquents… La pression sur l’environnement du gastéropode est forte.
                        Mais la principale cause de menace qui pèse sur l’escargot vient de l’urbanisation. En effet, toutes constructions de routes ou d’infrastructures tendent à dégrader et à détruire son habitat et in fine, à réduire son milieu de vie.
                    </p>
                    <br>
                    <h5>Comment participer à l’ « opération escargots » ?</h5>
                    <br>
                    <p>L’ « opération escargots » du Muséum national d’Histoire naturelle propose à tous les citoyens de suivre les escargots dans leur jardin. Pour aider les petits mollusques terrestres, on vous explique la marche à suivre.
                        Pour s’inscrire au programme, rendez-vous sur le site de Qubs, qui propose d’autres missions de sciences participatives, pour vous inscrire et vous informer.
                        Le principe est simple : vous devez installer un abri à escargots. Il peut s’agir d’une planche en bois non-traitée ou bien d’une soucoupe en terre cuite naturelle que vous posez au sol, de préférence dans une zone abritée (sous une haie, près d’un arbre ou d’un mur par exemple).
                    </p>

                    <p>En effet, les jardins sont des espaces auxquels les chercheurs n’ont pas accès. C’est sans compter qu’ils représentent une surface importante : selon le média spécialisé Jardins de France, il y a 13 millions de jardins privés sur notre territoire. Et autant d’écosystèmes.
                        « En savoir plus sur ce qu’il se passe derrière nos clôtures est essentiel si on veut faire avancer la protection de la biodiversité », synthétise l’experte.
                    </p>
                    <a href="javascript:void(0)" onclick="togglePopup(1)" class="popup-exit">Fermer</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ARTICLE 2 - FOURMI -->
    <div class="div_article2">
        <img src="../assets/img/fourmi.jpg" height="300" width="400" alt="image_fourmi" class="img_article2" >
        <div class="div_text2">
            <h2>"Une des 3 fourmis les plus envahissantes au monde"</h2>
            <p>
                De son côté, l'Inventaire national du patrimoine naturel (INPN) alerte sur le caractère très envahissant de cette espèce, l'une "des 3 fourmis les plus envahissantes du monde" et "incluse depuis peu dans la liste des espèces préoccupantes pour l'Union européenne".
                "Ses impacts écologiques et économiques sont majeurs", précise l'institution sur son site internet.
                L'institut lance d'ailleurs un appel aux habitants du secteur pour déterminer la taille de la zone envahie, qu'elle estime pour le moment à "environ 5.000 m² à Toulon".
                Mais l'espèce étant facilement transportée dans des plantes ou des déchets verts, "il est probable que d'autres zones soient envahies", précise l'INPN.
            </p>
            <div id="div_button2">
                <button onclick="togglePopup(2)">En savoir plus</button>
            </div>

            <div id="popup_art2">
                <div id="popup-content2">
                <h4>La Fourmi éléctrique, une espèce invasive,détectée,pour la première fois en France à Toulon</h4>
                <br>
                    <h6>L'espèce est très probablement arrivée en France lors d'un transport de plantes. Particulièrement envahissante, elle va devoir faire l'objet d'un plan d'éradication.</h6>
                    <br>
                    <p> C'est une première en France métropolitaine. Des fourmis électriques, une espèce très envahissante d'insectes originaires d'Amérique du Sud, a été observée pour la première fois à Toulon en septembre dernier.
                        C'est Olivier Blight, chercheur à l'Institut méditerranéen de biodiversité et d'écologie à Avignon, qui a fait cette observation dans une résidence fermée du bord de mer de Toulon, rapporte l'AFP. Il évoque même une "super-colonie" qui pourrait être là "depuis plus d'un an".
                        Jusqu'à présent, la fourmi électrique n'avait été observée qu'une seule fois en Europe, dans la région de Malaga en Espagne. Olivier Blight suppose qu'elle a été introduite en France "lors d'un transport de plante".
                        L'espèce doit son nom à sa piqûre qui provoque une sensation de piqûre d'ortie, "en plus fort et plus long, puisque ça dure 2-3 heures". Si la piqûre a avant tout pour but de neutraliser d'autres animaux, elle peut tout de même provoquer des chocs anaphylactiques chez les humains allergiques.
                    </p>
                    <br>
                    <h5>"Une des 3 fourmis les plus envahissantes au monde"</h5>
                    <br>
                    <p>De son côté, l'Inventaire national du patrimoine naturel (INPN) alerte sur le caractère très envahissant de cette espèce, l'une "des 3 fourmis les plus envahissantes du monde" et "incluse depuis peu dans la liste des espèces préoccupantes pour l'Union européenne".
                        "Ses impacts écologiques et économiques sont majeurs", précise l'institution sur son site internet. L'institut lance d'ailleurs un appel aux habitants du secteur pour déterminer la taille de la zone envahie, qu'elle estime pour le moment à "environ 5.000 m² à Toulon".
                        Mais l'espèce étant facilement transportée dans des plantes ou des déchets verts, "il est probable que d'autres zones soient envahies", précise l'INPN.
                        L'INPN appelle donc les habitants à prendre en photo les fourmis s'ils en aperçoivent afin de les transmettre au registre INPN Espèces, ou bien à envoyer des spécimens morts dans du coton ou un tube avec de l'alcool à l'Institut méditerranéen de biodiversité et d'écologie, afin qu'il puisse réaliser des analyses pour déterminer l'origine exacte de l'insecte.
                        Olivier Blight rappelle quant à lui que la présence de cette espèce envahissante nécessite un plan d'éradication, comparable à celui pour le moustique-tigre, que les autorités ont trois mois pour mettre en place depuis qu'il a signalé la présence de fourmis électriques.
                    </p>
                    <a href="javascript:void(0)" onclick="togglePopup(2)" class="popup-exit">Fermer</a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Découvrir -->
<div class="div_decouvrir">
    <h3> 75.4 millions d'espèces</h3>
</div>

<!--infos-->
<div class="div_infos">
    <div class="partie1">
        <div class="cercle">
            <i class="fi fi-sr-badge"></i>
        </div>
        <div class="div_p">
            <p>Découvrez la diversité des espèces qui habitent notre planète afin d'approfondir vos connaissances sur ces créatures fascinantes. </p>
        </div>
        <a class="button_link" href="frontController.php?controller=espece&action=search">
            <button>En savoir plus</button>
        </a>
    </div>
    <div class="partie2">
        <div class="cercle">
            <i class="fi fi-sr-map-marker"></i>
        </div>
        <div class="div_p">
            <p>Explorez votre environnement en découvrant les différentes espèces qui vous entourent</p>
        </div>
        <a class="button_link" href="http://127.0.0.1/SAE3.01/decouvrir.php">
            <button>Découvrir</button>
        </a>
    </div>
    <div class="partie3">
        <div class="cercle">
            <i class="fi fi-sr-bookmark"></i>
        </div>
        <div class="div_p">
            <p>Consultez les différentes naturothèques, en toute simplicité afin d’admirer les espèces préférées avec facilité</p>
        </div>
        <a class="button_link" href="frontController.php?controller=naturotheque&action=readAll">
            <button>Naturothèques</button>
        </a>
    </div>
</div>
<script src="../assets/js/scriptAccueil.js"></script>
</html>

<?php
?>
