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


<!-- RECHERCHE -->
<form>
        
<nav class="barre_recherche">
            <input type="search" id="marecherche" name="recherche" placeholder="Rechercher sur le site">
            <button type="submit">Rechercher</button>
            
            <span class="validity"></span>
        </nav>
</form>

<!-- SLIDER -->
<div class="slider">
        <img src="../assets/img/test2.jpg" alt="img1" class="img__slider active" />
        <img src="../assets/img/ecureil.jpg" alt="img2" class="img__slider" />
        <img src="../assets/img/chevreuil.jpg" alt="img3" class="img__slider" />
        <img src="../assets/img/ours.jpg" alt="img4" class="img__slider" />
        <img src="../assets/img/renard2.jpeg" alt="img5" class="img__slider" />
        <img src="../assets/img/loup.jpg" alt="img6" class="img__slider" />


        <div class="suivant">
            <i class="fas fa-chevron-circle-right"></i>        
        </div>
        <div class="precedent">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
    </div>

<!--PARTIE JS-->
    <script type="text/javascript">
        let img__slider = document.getElementsByClassName('img__slider');

let etape = 0;

let nb__img = img__slider.length;

let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant');

function enleverActiveImages() {
    for(let i = 0 ; i < nb__img ; i++) {
        img__slider[i].classList.remove('active');
    }
}

suivant.addEventListener('click', function() {
    etape++;
    if(etape >= nb__img) {
        etape = 0;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
})

precedent.addEventListener('click', function() {
    etape--;
    if(etape < 0) {
        etape = nb__img - 1;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
})

setInterval(function() {
    etape++;
    if(etape >= nb__img) {
        etape = 0;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
}, 3000)
        </script>

<!-- Se connecter-->
<div class="div_connecter">
    <h3 class="first">
    <a href="http://localhost/SAE3.01/web/frontController.php?controller=naturotheque&action=readAll">Accéder à ma Naturothèque </a>
    </h3>
    
    <div class = "separation">
    </div>
    
    <h3 class = "second" >
        <a href="http://localhost/SAE3.01/web/frontController.php?controller=utilisateur&action=connection"> Vous n’êtes pas encore inscrit </a>
    </h3>

</div>


<!--ARTICLE 1 - ESCARGOT -->
<div class ="div_article1">
    <img src="../assets/img/escargot.jpg" height="300" widht="300" alt="image_escargot" class="img_article">

    <div class = "div_text1"> 

        <h2>"11 % des escargots sont menacés"</h2>
        <p>Dès que la pluie est là, ils pointent le bout de leurs antennes. Connus de tous, les escargots sont pourtant pleins de mystères.
            En France, 691 espèces sont recensées par l’Inventaire national du patrimoine naturel (INPN). 
            Parmi elles, un tiers n’existe nulle part ailleurs dans le monde. Aucun doute : l’Hexagone est bien le pays du plus célèbre des mollusques terrestres.
            Et pourtant, on ne fait pas assez pour ces petites bêtes. L’INPN établit que 41 % des espèces, soit près de la moitié, sont trop mal connues en France pour que leur statut de conservation puisse être évalué. 
            Pour contrecarrer ces données insuffisantes, vous pouvez agir. En avril 2023, le Muséum national d’Histoire naturelle a lancé une « opération escargots ». 
            On vous explique de quoi il s’agit et comment vous pouvez contribuer.
        </p> 

        <div class = "div_button">
        <a class = "button_link" href="https://actu.fr/planete/biodiversite/escargots-dans-votre-jardin-vous-pouvez-aider-les-scientifiques-a-les-sauver_59288356.html" target="_blank">
        <button>En savoir plus</button>
        </a>
        </div> 

    </div>

</div>

<!-- ARTICLE 2 - FOURMI -->
<div class="div_article2">

    <img src="../assets/img/fourmi.jpg" height="300" widht ="300" alt="image_fourmi" class="img_article2" >



    <div class = "div_text2">
   
        <h2>"Une des 3 fourmis les plus envahissantes au monde"</h2>
        <p>
            De son côté, l'Inventaire national du patrimoine naturel (INPN) alerte sur le caractère très envahissant de cette espèce, l'une "des 3 fourmis les plus envahissantes du monde" et "incluse depuis peu dans la liste des espèces préoccupantes pour l'Union européenne".
            "Ses impacts écologiques et économiques sont majeurs", précise l'institution sur son site internet. 
            L'institut lance d'ailleurs un appel aux habitants du secteur pour déterminer la taille de la zone envahie, qu'elle estime pour le moment à "environ 5.000 m² à Toulon".
            Mais l'espèce étant facilement transportée dans des plantes ou des déchets verts, "il est probable que d'autres zones soient envahies", précise l'INPN.
        </p> 

        <div class="div_button2">
        <a class = "button_link" href="https://www.bfmtv.com/var/la-fourmi-electrique-une-espece-invasive-detectee-pour-la-premiere-fois-en-france-a-toulon_AN-202210200394.html" target="_blank">
        <button>En savoir plus</button>
        </a> 
        </div>
</div>
</div>



        <!-- Découvrir -->
        <div class =div_decouvrir>
            <h3> 75.4 millions d'espèces</h3>
        </div>

        <!--infos-->

        <div class="div_infos">
            
            <div class = "partie1">
                <div class = "cercle">
                    <i class="fi fi-sr-badge"></i> 
                </div> 
                <div class ="div_p">
                    <p>Découvrez l'espèce la plus consultée, pour en apprendre davantage sur cette espèce fascinante </p>    
                </div>   
                <a class = "button_link" href="">
                    <button>En savoir plus</button>
            </div>
        
            <div class = "partie2">
                <div class = "cercle">
                    <i class="fi fi-sr-map-marker"></i>
                </div>
                <div class = "div_p">
                    <p>Explorez votre environnement en découvrant les différentes espèces qui vous entourent</p>
                </div>
                <a class = "button_link" href="http://127.0.0.1/SAE3.01/decouvrir.php">
                <button>Découvrir</button> 
            </div>
            
            <div class = "partie3">
                <div class ="cercle">
                    <i class="fi fi-sr-bookmark"></i>
                </div>
                <div class="div_p">
                    <p>Consultez les différentes naturothèques, en toute simplicité afin d’admirer les espèces préférées avec facilité</p>       
                </div>
                <a class = "button_link" href="http://localhost/SAE3.01/web/frontController.php?controller=naturotheque&action=readAll" target="_blank">
                <button>Naturothèques</button>
            </div>
        </div>
       
<!-- Se connecter-->
<!-- <div class="div_connecter">
    <h3>Acceder à ma Naturothèque</h3>

        <a href="http://localhost/SAE3.01/web/frontController.php?controller=utilisateur&action=connection">
        <button>Se connecter</button>
    </a>
</div> -->

<!--Decouvrir-->
<!-- <div class="div_decouvrir">
    <h3>75,4 Espèces</h3>
    <a href="http://127.0.0.1/SAE3.01/decouvrir.php">
        <button>Découvrir</button>
    
</div>
 -->

<!-- Espace Videos-->
<!-- <div class="div_videos">
<h3>Vidéos</h3>
    <div class="video">
        <iframe width="280" height="161" src="https://www.youtube.com/embed/aOnmucUbDUw?si=p3MQNzw7qYWF5R6c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>    
    </div>
    <div class="video">
        <iframe width="280" height="161" src="https://www.youtube.com/embed/0O9T24QnqrY?si=xo8Wj2TWiOk7jfMB" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <div class="video">
    <iframe width="280" height="161" src="https://www.youtube.com/embed/-2PGG33W2Eg?si=T_f5CytPDX1Cga50" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
</div> -->

</html>


<?php
?>
