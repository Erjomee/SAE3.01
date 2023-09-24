// Pour faire basculer la nav barre au click du menu déroulant
document.getElementById('menu-icon').addEventListener("click",function () {
    document.getElementById('menu-icon').classList.toggle("bx-x");
    document.querySelector(".nav-list").classList.toggle("open")
})