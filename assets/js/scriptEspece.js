function rechercher(page_active){
    resetSearch();

    var recherche = document.getElementById('marecherche').value;
    var filtre = document.querySelector('input[name=filtre_f]:checked').value;
    var size = document.getElementById("size").value;

    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';
    var params = 'controller=espece&action=searchBy' + '&filtre_f=' + filtre + '&recherche=' + recherche + "&page=" + page_active + "&size=" + size;
    console.log(params);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // document.getElementById('resultat').innerHTML = xhr.responseText;
            console.log(xhr.responseText);
            var reponse = JSON.parse(xhr.responseText);
            document.getElementById("default_message").innerHTML = reponse["default"];


            // Mise en forme des données sur la page 
            document.getElementById("resultat").innerHTML = reponse["result"];  // ne plus utiliser ca 


            // Système de pagination
            const paginationElement = document.getElementById("pagination");


            if (page_active != 1) {
                const prev_arrow = document.createElement("i");
                prev_arrow.setAttribute("id","prev_arrow");
                prev_arrow.classList.add("bx")
                prev_arrow.classList.add("bx-left-arrow-alt")
                prev_arrow.classList.add("next_prev_activated")
                prev_arrow.addEventListener("click", () => rechercher(page_active-1));
                paginationElement.appendChild(prev_arrow);
            }

            for (let i = 1; i <= reponse["nbr_page"]; i++) {
                console.log(i);
                const li = document.createElement("li");
                if ((i == 1 )|| (page_active - 2 <= i && i <= page_active) || (page_active <= i  && i <= page_active + 2) ||(i==reponse["nbr_page"])) {
                    li.textContent = i;
                    if (i == page_active) {
                        li.classList.add("page_active");
                    }
                    li.addEventListener("click", () => rechercher(i));
                    paginationElement.appendChild(li);
                }
                else{
                    if (i<page_active) {
                        if (!document.querySelector(".page_interval_before")) {
                            li.textContent = "..."
                            li.classList.add("page_interval_before");
                            paginationElement.appendChild(li);
                        }
                    }else{
                        if(!document.querySelector(".page_interval_after")){
                            li.textContent = "..."
                            li.classList.add("page_interval_after");
                            paginationElement.appendChild(li);
                        }
                    }
                }
            }

            if (page_active != reponse["nbr_page"]) {
                const next_arrow = document.createElement("i");
                next_arrow.setAttribute("id","next_arrow");
                next_arrow.classList.add("bx")
                next_arrow.classList.add("bx-right-arrow-alt")
                next_arrow.classList.add("next_prev_activated")
                next_arrow.addEventListener("click", () => rechercher(page_active+1));
                paginationElement.appendChild(next_arrow);
            }

            document.getElementById('result_area').style.backgroundImage = "none"
            redirectToTop();
        }

    };
    xhr.open("GET", url + params, true);
    xhr.send(null);

}


function more_info(id) {

    // Etat initial popup
    resetPopup();

    // Remplissage des informations
    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';
    var params = 'controller=espece&action=moreInfo' + '&taxrefIds=' + id;

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // document.getElementById('resultat').innerHTML = xhr.responseText;
            var reponse = JSON.parse(xhr.responseText);

            document.getElementById("slider").innerHTML = reponse["image"];
            animateSlider();

            // On stock les donnés de l'espece clické
            let data = reponse["result"][0] ;
            console.log(data);

            // TETE
            document.getElementById('first_title').innerHTML = data["frenchVernacularName"] ;
            document.getElementById('second_title').innerHTML = "ID:" +id +" | "+ data["fullNameHtml"] ;

            // Fiche descriptive
            if (!!reponse["description"]) {
                document.getElementById("portrait").innerHTML = reponse["description"]["text"];
            }

            // HABITAT
            var image = document.getElementById("img_habitat");
            if (data["habitat"] != null) {
                image.src = "./../assets/img/taxon/"+data["habitat"]["id"]+".png";
                document.getElementById("habitat_titre").innerHTML = data["habitat"]["name"];
                document.getElementById("habitat_description").innerHTML = data["habitat"]["definition"];
            }else{
                document.getElementById("habitat").style.display = "none";
                document.getElementById("habitat_manquante").style.display = "flex";
            }
            

            // STATUTS
            if (data["statuts"] != null) {
                var lst_statuts = "";
                for (const key in data["statuts"] ) {
                    if (Object.hasOwnProperty.call(data["statuts"] , key)) {
                        const element = data["statuts"][key];
                        lst_statuts += "<tr><td>"+element["zone"]+"</td><td>"+element["statut"]+"</td><td>"+element["description"]+"</td><td>"+element["definition"]+"</td></tr>";
                    }
                }
                document.getElementById("statuts").innerHTML = lst_statuts;
            }else{
                document.getElementById("statuts").innerHTML = "Donnée manquante";
            }


            // Classification
            // On parcours chaque rang taxonomique
            lst_rang = ["Domaine" , "Règne" , "Phylum" , "Classe" , "Ordre" , "Famille" , "Genre"];
            for (const rang in data["classification"]) {
                if (Object.hasOwnProperty.call(data["classification"], rang)) {
                    for (const sous_rang in data["classification"][rang]) {
                        if (Object.hasOwnProperty.call(data["classification"][rang], sous_rang)) {
                            for (const rang_name in data["classification"][rang][sous_rang]) {
                                if (Object.hasOwnProperty.call(data["classification"][rang][sous_rang], rang_name)) {
                                    if (lst_rang.includes(rang_name)){
                                        document.getElementById("rang_liste").innerHTML += "<strong>" + rang_name +"</strong>: "+ data["classification"][rang][sous_rang][rang_name] + "<br><br>";
                                    }else{
                                        document.getElementById("rang_liste").innerHTML += "<li>" + "<span style='color: grey; display: inline;'>" +rang_name +"</span>: "+ data["classification"][rang][sous_rang][rang_name] + "</li><br>";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // document.getElementById("rang_liste").innerHTML = data["classification"]["Domaine"][0]["Domaine"];

            // Carte
            const imageLeft = document.getElementById("map-left");
            const imageRight = document.getElementById("map-right");
            if (data["gbifId"] != null) {
                imageLeft.setAttribute("src" , "https://api.gbif.org/v2/map/occurrence/density/0/0/0@4x.png?srs=EPSG:4326&bin=hex&hexPerTile=180&taxonKey="+ data["gbifId"] +"&style=classic.poly") ;
                imageRight.setAttribute("src" , "https://api.gbif.org/v2/map/occurrence/density/0/1/0@4x.png?srs=EPSG:4326&bin=hex&hexPerTile=180&taxonKey="+ data["gbifId"] +"&style=classic.poly");
            }else{
                imageLeft.style.display = "none";
                imageRight.style.display = "none";
            }

            document.getElementById('popupInfo').style.backgroundImage = "none";
            document.getElementById("hidden").style.display = "block";
        }
    };

    xhr.open("GET", url + params, true);
    xhr.send(null);


    // Fermeture du popup
    document.getElementById('closePopup').addEventListener('click', function() {
        document.getElementById('popup').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('popup')) {
            document.getElementById('popup').style.display = 'none';
        }
    });
}

// function NextAndPreviousPage(active_page, max_page) {
//     const previous_page = document.getElementById("previous_arrow");
//     const next_page = document.getElementById("next_arrow");
//     if (max_page > 1) {
//         if (active_page == 1) {
//             next_page.style.display = "block";

//             next_page.classList.add("next_prev_activated");
//             next_page.addEventListener("click", function() {
//                 NextPage(active_page);
//             });

//             previous_page.style.display = "none";
//         } else if (active_page == max_page) {
//             previous_page.style.display = "block";

//             previous_page.classList.add("next_prev_activated");
//             previous_page.addEventListener("click", function() {
//                 PrevPage(active_page);
//             });

//             next_page.style.display = "none";
//         }else{
//             next_page.style.display = "block";

//             next_page.classList.add("next_prev_activated");
//             next_page.addEventListener("click", function() {
//                 NextPage(active_page);
//             });

//             previous_page.style.display = "block";

//             previous_page.classList.add("next_prev_activated");
//             previous_page.addEventListener("click", function() {
//                 PrevPage(active_page);
//             });
//         }
//     }
// }

// function NextPage(active_page) {
//     rechercher(active_page + 1);
// }

// function PrevPage(active_page) {
//     rechercher(active_page - 1);
// }

// // On verfifie le bon chargement des media
// document.addEventListener('DOMContentLoaded', (event) => {
//     // Image espece
//     const divsACacher = document.querySelectorAll('.img__slider');
    
//     // Cache chaque élément div sélectionné
//     divsACacher.forEach((element) => {
//         element.style.display = 'none';
//     });

//     // Carte 
//     const imageLeft = document.getElementById("map-left");
//     const imageRight = document.getElementById("map-right");
//     if (imageLeft && (!imageLeft.complete || imageLeft.naturalWidth === 0)) {
//         imageLeft.style.display = "none"; // Cacher l'image si la source n'est pas valide
//     }
//     if (imageRight && (!imageRight.complete || imageRight.naturalWidth === 0)) {
//         imageRight.style.display = "none"; // Cacher l'image si la source n'est pas valide
//     }
// });

function activeOnglet(onglet = "default"){
    let lst_onglet = {"onglet1":"description","onglet2":"taxon","onglet3":"interraction","onglet4":"observation"}

    for (const onglet in lst_onglet) {
        document.getElementById(lst_onglet[onglet]).style.display = "none";
        document.getElementById(onglet).classList.remove("active");
    }

    switch (onglet){
        case "default":
            document.getElementById("onglet1").classList.add("active");
            document.getElementById(lst_onglet["onglet1"]).style.display = "block";
            break
        default:
            document.getElementById(onglet).classList.add("active");
            document.getElementById(lst_onglet[onglet]).style.display = "block";
            break
    }
}

function animateSlider(){
    let img__slider = document.getElementsByClassName('img__slider');
    let etape = 0;
    let nb__img = img__slider.length;
    let precedent = document.querySelector('.precedent');
    let suivant = document.querySelector('.suivant');

    if (nb__img !== 1) {
        suivant.addEventListener('click', function () {
            etape++;
            if (etape >= nb__img) {
                etape = 0;
            }
            for (let i = 0; i < nb__img; i++) {
                img__slider[i].classList.remove('active');
            }
            img__slider[etape].classList.add('active');
        })

        precedent.addEventListener('click', function () {
            etape--;
            if (etape < 0) {
                etape = nb__img - 1;
            }
            for (let i = 0; i < nb__img; i++) {
                img__slider[i].classList.remove('active');
            }
            img__slider[etape].classList.add('active');
        })
    }
}

function resetSearch(){
    document.getElementById('default_message').innerHTML = "";
    document.getElementById('resultat').innerHTML = "";
    document.getElementById('pagination').innerHTML = "";
    document.getElementById('result_area').style.backgroundImage = "url(./../assets/img/loading.gif)";
}


function resetPopup() {

    // Affichage du popup
    document.getElementById('popup').style.display = 'block';
    document.getElementById('popupInfo').style.backgroundImage = "url(./../assets/img/loading.gif)"
    document.getElementById("hidden").style.display = "none";
    activeOnglet('onglet1');

    // On reinitialise les div d'informations
    //Description
    document.getElementById("portrait").innerHTML = "";
    document.getElementById("description_manquante").style.display = "none";

    // Habitat
    document.getElementById("habitat").style.display = "flex";
    document.getElementById("habitat_manquante").style.display = "none";

    // Classification
    document.getElementById("rang_liste").innerHTML = "";

    // Carte
    document.getElementById("map-left").style.display = "block";
    document.getElementById("map-right").style.display = "block";
}

function redirectToTop() {
    // Utilisez l'élément <body> comme cible
    document.body.scrollIntoView({ behavior: "smooth" });
}