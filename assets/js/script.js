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
        document.querySelector(".nav-list").classList.toggle("display")
        document.querySelector(classUser).classList.remove("display")
        // document.querySelector(".utilisateur").classList.remove("white-bg")
        // document.querySelector(".menu").classList.toggle("gray-bg");
        document.getElementById('user-icon').classList.remove("bx-tada");

    })

    // Gestion du clic sur le user icon
    document.querySelector(".utilisateur").addEventListener("click",function () {
        // document.querySelector(".utilisateur").classList.toggle("white-bg");
        document.querySelector(classUser).classList.toggle("display");
        document.querySelector(".nav-list").classList.remove("display")
        document.getElementById("menu-icon").classList.remove("bx-x");
        // document.querySelector(".menu").classList.remove("gray-bg")
        document.getElementById('user-icon').classList.toggle("bx-tada");
    })

    // Animation icon user
    // document.querySelector(".utilisateur").addEventListener("mouseenter",function () {
    //     document.getElementById('user-icon').classList.add("bx-tada");
    // })
    // document.querySelector(".utilisateur").addEventListener("mouseleave",function () {
    //     document.getElementById('user-icon').classList.remove("bx-tada");
    // })
}



function submitForm() {
    document.getElementById("myForm").submit();
}