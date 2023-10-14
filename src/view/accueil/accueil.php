
<form>
        <nav class="nav_recherche">
            <input type="search" id="marecherche" name="recherche" placeholder="Rechercher sur le site">
            <button type="submit">Rechercher</button>
            <span class="validity"></span>
        </nav>
</form>

<div class="slider">
        <img src="libellule.jpeg" alt="img1" class="img__slider active" />
        <img src="renard.jpeg" alt="img2" class="img__slider" />
        <img src="lynx.jpeg" alt="img3" class="img__slider" />
        <div class="suivant">
            <i class="fas fa-chevron-circle-right"></i>        
        </div>
        <div class="precedent">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
    </div>
    <script type="text/javascript">
        let img__slider = document.getElementsByClassName('img__slider');

let etape = 0;

let nbr__img = img__slider.length;

let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant');

function enleverActiveImages() {
    for(let i = 0 ; i < nbr__img ; i++) {
        img__slider[i].classList.remove('active');
    }
}

suivant.addEventListener('click', function() {
    etape++;
    if(etape >= nbr__img) {
        etape = 0;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
})

precedent.addEventListener('click', function() {
    etape--;
    if(etape < 0) {
        etape = nbr__img - 1;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
})

setInterval(function() {
    etape++;
    if(etape >= nbr__img) {
        etape = 0;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
}, 3000)
        </script>


<?php


    echo "<h1> Accueil </h1>";

?>

