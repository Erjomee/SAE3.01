// Pour faire bascuuler la nav barre au click du menu déroulant
document.getElementById('menu-icon').addEventListener("click",function () {
    document.getElementById('menu-icon').classList.toggle("bx-x");
    document.querySelector(".nav-list").classList.toggle("open")
})

// feozbfoezf
document.querySelector(".utilisateur").addEventListener("click",function () {
    document.getElementById('user-icon').classList.toggle("bx bxs-user-circle bx-tada");
    console.log("lefole")
})