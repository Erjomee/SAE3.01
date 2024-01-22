function toggle_filters() {
    console.log('gegeg');
    const icon = document.getElementById("icon-filtre");
    const filtre = document.getElementById("filtre");

    if (icon.classList.contains("bxs-chevron-up")) {
        icon.classList.remove("bxs-chevron-up");
        icon.classList.add("bxs-chevron-down");
    } else {
        icon.classList.remove("bxs-chevron-down");
        icon.classList.add("bxs-chevron-up");
    }

    filtre.classList.toggle("display");
}


function rechercher(page_active){
    resetSearch();
    redirectToResult();

    var recherche = document.getElementById('marecherche').value;
    var filtre = document.querySelector('input[name=filtre_f]:checked').value;
    var size = document.getElementById("size").value;
    var habitats = document.getElementById("habitats-select").value;
    var taxonomicRanks = document.getElementById("rang-select").value;
    var territories = document.getElementById("territories-select").value;
    var domain = document.getElementById("domain-select").value;
    var image = document.getElementById("image-checkbox").checked;

    if (image == true ) {
        image = 1;
    }else{
        image = 0;
    }

    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';
    var params = 'controller=espece&action=searchBy' + '&filtre_f=' + filtre + '&recherche=' + recherche + "&page=" + page_active + "&size=" + size 
                 + "&habitats=" + habitats + "&taxonomicRanks=" + taxonomicRanks + "&territories=" + territories + "&domain=" + domain + "&image=" + image;
    console.log(params);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // document.getElementById('resultat').innerHTML = xhr.responseText;
            console.log(xhr.responseText);
            var reponse = JSON.parse(xhr.responseText);
            document.getElementById("default_message").innerHTML = reponse["default"];


            console.log(reponse["data"]);

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

            if (page_active != reponse["nbr_page"] && reponse["result"] != null) {
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
    
    // Gestionnaire d'événement pour l'événement d'erreur
    xhr.onerror = function() {
        console.error("Erreur réseau lors de la requête.");
    };

    xhr.open("GET", url + params, true);
    xhr.send(null);
}


var id_courant = null;
var mySlider =null
function more_info(id) {

    id_courant = id;

    if (mySlider == null) {
        mySlider = new rSlider({
            target: '#slider-date',
            values: { min: 1970, max: 2024 },
            step: 1,
            set: [2000 , 2024],
            range: true,
            scale: true,
                onChange: function (values) {
                      // Mettez à jour le graphique ou effectuez d'autres actions ici
                      var valeurs = values.split(',');
        
                      // Maintenant, valeurs est un tableau contenant les parties séparées
                      var debut = parseInt(valeurs[0]);  // Convertir en entier
                      var fin = parseInt(valeurs[1]);
        
                      updatechart(id_courant , debut ,fin)
                  }
            }
        );
    }

    updatechart(id_courant , parseInt(mySlider.getValue().split(',')[0]) ,parseInt(mySlider.getValue().split(',')[1]))

    // Etat initial popup
    resetPopup();

    // Remplissage des informations
    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';
    var params = 'controller=espece&action=moreInfo' + '&taxrefIds=' + id;

    console.log(url +params);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // document.getElementById('resultat').innerHTML = xhr.responseText;
            var reponse = JSON.parse(xhr.responseText);
            console.log(reponse["like_save"]);

            document.getElementById("popup_save_like").innerHTML = reponse["like_save"];

            document.getElementById("slider").innerHTML = reponse["image"];
            animateSlider();

            // On stock les donnés de l'espece clické
            let data = reponse["result"][0] ;
            console.log(data);

            // TETE
            document.getElementById('first_title').innerHTML = data["frenchVernacularName"] ;
            document.getElementById('second_title').innerHTML = "ID:" +id +" | "+ data["fullNameHtml"] ;

            // Fiche descriptive
            if (reponse["description"] != null) {
                document.getElementById("portrait").innerHTML = reponse["description"]["text"];
            }else{
                document.getElementById("onglet1").style.display = "none";
                activeOnglet('onglet2')
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


            // Graphique
    

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


function enregistrer(id_espece, table , nom , image) {
    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';
    var params = "controller=naturotheque&action=enregistrer" + "&table=" + table+ "&id=" + id_espece + "&nom=" + nom + "&image=" + image;

    console.log(url+params);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            const item = document.getElementById(id_espece+table);

            if (table == "naturotheque") {
                item.classList.remove("bx-bookmarks");
                item.classList.add("bx-check");
            }else{
                item.classList.remove("bx-heart");
                item.classList.add("bxs-heart");
            }

            item.onclick = function() { retirer(id_espece,table); };
        }
    };
    xhr.open("GET", url + params, true);
    xhr.send(null);
}


function retirer(id_espece,table) {
    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';
    var params = 'controller=naturotheque&action=retirer' + '&id=' + id_espece +'&table='+table;
    console.log(params);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            const item = document.getElementById(id_espece+table);

            if (table == "naturotheque") {
                item.classList.remove("bx-check");
                item.classList.add("bx-bookmarks");
            }else{
                item.classList.remove("bxs-heart");
                item.classList.add("bx-heart");
            }
            
            item.onclick = function() { enregistrer(id_espece,table); };
        }
    };
    xhr.open("GET", url + params, true);
    xhr.send(null);
    
}


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


function redirectToResult() {
    // Utilisez l'élément <body> comme cible
    document.getElementById("filtre").scrollIntoView({ behavior: "smooth" });
}



// Récupérez les boutons radio et le champ de saisie
const radio1 = document.getElementById("radio1");
const radio2 = document.getElementById("radio2");
const radio3 = document.getElementById("radio3");
const marecherche = document.getElementById("marecherche");


// Écoutez les clics sur les boutons radio
radio1.addEventListener("click", function() {
    marecherche.placeholder = "Nom vernaculaire | ex: Pinson familier";
});

radio2.addEventListener("click", function() {
    marecherche.placeholder = "ID | ex: 442365";
});

radio3.addEventListener("click", function() {
    marecherche.placeholder = "Nom scientifique | ex: Spizella passerina";
});




// Sélectionnez tous les boutons radio et leurs labels
const radioButtons = document.querySelectorAll('input[type="radio"]');
const labels = document.querySelectorAll('#filtreList label');

// Ajoutez un gestionnaire d'événements de clic à chaque bouton radio
radioButtons.forEach((radioButton, index) => {
    radioButton.addEventListener('change', () => {
        // Réinitialisez tous les labels
        labels.forEach(label => {
            label.style.backgroundColor = 'white';
            label.style.color = '#26B2A2';
            label.style.boxShadow = '';
        });

        // Mettez à jour le style du label sélectionné
        labels[index].style.backgroundColor = '#26B2A2';
        labels[index].style.color = 'white';
        labels[index].style.boxShadow = 'rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px';



    });
});


// CHART OBSERVATION
var chart_info = initialiseChart(1) 


function initialiseChart(params) {
    console.log(params);

    // Données initiales pour le graphique (dates et valeurs)
    var initialData = {
        labels: ['0'],
        datasets: [{
            label: 'Valeurs',
            data: [0],
            backgroundColor: '#26B2A2',
            borderColor: '#26B2A2',
            borderWidth: 1
        }]
    };

    // Configuration du graphique
    var options = {
        scales: {
            x: [{
                type: 'linear', // Utilisez l'échelle linéaire pour les années
                position: 'bottom'
            }],
            y: [{
                type: 'linear', // Utilisez l'échelle linéaire pour les valeurs y
                position: 'left'
            }]
        },
    };

    // Création du graphique
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'line', // Type de graphique (ligne dans cet exemple)
    data: initialData,
    options: options
    });

    updatechart()

    return myChart;
}

function updatechart(id ,debut , fin) {

    if (id != null) {
        var debutYear = debut;
        var finYear = fin;

        var requests = [];
        for (var year = debutYear; year <= finYear; year++) {
            requests.push(makeRequest(year));
        }

        Promise.all(requests)
            .then(function(counts) {
                var dataYear = Array.from({ length: finYear - debutYear + 1 }, (_, index) => (parseInt(debutYear) + index).toString());
                var dataValue = counts;

                var newData = {
                    labels: dataYear,
                    datasets: [{
                        label: 'Occurence d\'obsrvation',
                        data: dataValue, // Nouvelles valeurs
                        backgroundColor: '#26B2A2',
                        borderColor: '#26B2A2',
                        borderWidth: 1
                    }]
                };
        updateChart(newData ,chart_info)
        })
        


        // Fonction pour effectuer la requête AJAX
        function makeRequest(year, callback) {
            return new Promise(function(resolve, reject) {
                var url = 'https://openobs.mnhn.fr/api/occurrences/stats/taxon/'+ id +'?startDate=' + year + '-01-01&endDate=' + year + '-12-29';
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                        var response = JSON.parse(xhr.responseText);
                        resolve(response["occurrenceCount"]);
                    }
                };
                xhr.open("GET", url, true);
                xhr.send(null);
            });
        }
    }
    
}     



// Fonction pour mettre à jour les données du graphique
function updateChart(newData,chart) {
    console.log(chart);
    chart.data = newData;
    chart.update();
  }

