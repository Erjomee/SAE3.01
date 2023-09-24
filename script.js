// Pour faire basculer la nav barre au click du menu déroulant
document.querySelector(".menu").addEventListener("click",function () {
    document.getElementById('menu-icon').classList.toggle("bx-x");
    document.querySelector(".nav-list").classList.toggle("open")
    document.querySelector(".user-list").classList.remove("open")
    document.querySelector(".utilisateur").classList.remove("white-bg")
    document.querySelector(".menu").classList.toggle("gray-bg");
})


// Pour faire basculer la nav barre au click du menu déroulant
document.querySelector(".utilisateur").addEventListener("click",function () {
    document.querySelector(".utilisateur").classList.toggle("white-bg");
    document.querySelector(".user-list").classList.toggle("open");
    document.querySelector(".nav-list").classList.remove("open")
    document.getElementById('menu-icon').classList.remove("bx-x");
    document.querySelector(".menu").classList.remove("gray-bg")
})


// Zone utilisateure
document.querySelector(".utilisateur").addEventListener("mouseenter",function () {
    document.getElementById('user-icon').classList.add("bx-tada");
})
document.querySelector(".utilisateur").addEventListener("mouseleave",function () {
    document.getElementById('user-icon').classList.remove("bx-tada");
})

