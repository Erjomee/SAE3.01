// NAV BAR
// On vérifie si la zone utilisateur existe (si l'utilisateur n'est pas invité)

if(document.querySelector(".user-list") !== null){
    classUser = ".user-list"
}else{
    classUser = ".user-deco-list"
}



if (document.querySelector(".utilisateur") !== null){ 
    // Gestion du clic sur le menu icon
    document.querySelector(".menu").addEventListener("click",function () {
        document.getElementById("menu-icon").classList.toggle("bx-x");
        document.querySelector(".nav-list").classList.toggle("open")
        document.querySelector(classUser).classList.remove("open")
        document.querySelector(".utilisateur").classList.remove("white-bg")
        document.querySelector(".menu").classList.toggle("gray-bg");
    })

    // Gestion du clic sur le user icon
    document.querySelector(".utilisateur").addEventListener("click",function () {
        document.querySelector(".utilisateur").classList.toggle("white-bg");
        document.querySelector(classUser).classList.toggle("open");
        document.querySelector(".nav-list").classList.remove("open")
        document.getElementById("menu-icon").classList.remove("bx-x");
        document.querySelector(".menu").classList.remove("gray-bg")
    })

    // Animation icon user
    document.querySelector(".utilisateur").addEventListener("mouseenter",function () {
        document.getElementById('user-icon').classList.add("bx-tada");
    })
    document.querySelector(".utilisateur").addEventListener("mouseleave",function () {
        document.getElementById('user-icon').classList.remove("bx-tada");
    })
}

// PAGE ESPECE

// Récupérez les boutons radio et le champ de saisie
const radio1 = document.getElementById("radio1");
const radio2 = document.getElementById("radio2");
const radio3 = document.getElementById("radio3");
const marecherche = document.getElementById("marecherche");


// Écoutez les clics sur les boutons radio
radio1.addEventListener("click", function() {
    marecherche.placeholder = "ID | ex: 442365";
});

radio2.addEventListener("click", function() {
    marecherche.placeholder = "Nom vernaculaire | ex: Pinson familier";
});

radio3.addEventListener("click", function() {
    marecherche.placeholder = "Nom scientifique | ex: Spizella passerina";
});

