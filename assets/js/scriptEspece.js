function rechercher(){
    var recherche = document.getElementById('marecherche').value;
    var filtre = document.querySelector('input[name=filtre_f]:checked').value;
    var page = document.getElementById("page").value;
    var size = document.getElementById("size").value;

    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';
    var params = 'controller=espece&action=searchBy' + '&filtre_f=' + filtre + '&recherche=' + recherche + "&page=" + page + "&size=" + size;

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // document.getElementById('resultat').innerHTML = xhr.responseText;
            var reponse = JSON.parse(xhr.responseText);
            document.getElementById("default_message").innerHTML = reponse["default"];
            document.getElementById("resultat").innerHTML = reponse["result"];

        }
    };
    xhr.open("GET", url + params, true);
    xhr.send(null);
}


function more_info(id) {

    // Affichage du popup
    document.getElementById('popup').style.display = 'block';


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


            let data = reponse["result"][0] ;
            console.log(data["frenchVernacularName"]);

            document.getElementById('first_title').innerHTML = data["frenchVernacularName"] ;
            document.getElementById('second_title').innerHTML = "ID:" +id +" | "+ data["fullNameHtml"] ;








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