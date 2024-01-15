// POPUP
function togglePopup(test) {
    id = "popup_art"+test;
    display = document.getElementById(id).style.display ; 
    if (display == "none") {
        document.getElementById(id).style.display = "block";
    }else {
        document.getElementById(id).style.display = "none";        
    }
}

// SLIDER
let img__slider = document.getElementsByClassName('img__slider');

let etape = 0;
let nb__img = img__slider.length;

let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant');

function enleverActiveImages() {
    for (let i = 0; i < nb__img; i++) {
        img__slider[i].classList.remove('active');
    }
}

suivant.addEventListener('click', function () {
    etape++;
    if (etape >= nb__img) {
        etape = 0;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
});

precedent.addEventListener('click', function () {
    etape--;
    if (etape < 0) {
        etape = nb__img - 1;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
});

setInterval(function () {
    etape++;
    if (etape >= nb__img) {
        etape = 0;
    }
    enleverActiveImages();
    img__slider[etape].classList.add('active');
}, 3000);
