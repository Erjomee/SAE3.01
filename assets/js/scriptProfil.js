
// MARCHE PAS
function upload_image() {
    const input = document.getElementById('changeImage');
    const preview = document.getElementById('previewImage');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // preview.src = e.target.result;

            var xhr = new XMLHttpRequest();
            var url = 'frontController.php?controller=utilisateur&action=change_image';
            var params = '&avatar=' + e.target.result;

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    // var response = JSON.parse(xhr.responseText);
                    console.log(xhr.responseText);
                    // Faire quelque chose en cas de succès
                    // Gérer les erreurs
                }
            };
        
            xhr.open("GET", url + params, true);
            // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(null);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


function submitForm() {
    document.getElementById('myForm').submit();
}


function selectTab(tabName , email) {

    var xhr = new XMLHttpRequest();
    var url = 'frontController.php?';

    // AFFICHER LES ENREGISTREMENTS
    // Ajouter la classe 'active' à l'onglet cliqué
    if (tabName === 'enregistre') {
        document.querySelector('.tab:nth-child(1)').classList.add('active');
        document.querySelector('.tab:nth-child(2)').classList.remove('active');


        document.querySelector(".grille").innerHTML = "";

        var params = 'controller=naturotheque&action=afficher_save' + '&email=' + email ;
        console.log(url  + params);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                // document.getElementById('resultat').innerHTML = xhr.responseText;
                var reponse = JSON.parse(xhr.responseText);
                console.log(reponse);

                for (const key in reponse) {
                    if (Object.hasOwnProperty.call(reponse, key)) {
                        console.log(reponse[key]);
                        let nomEspace = reponse[key]["nom"];
                        let photoEspace = reponse[key]["image"];

                        if (photoEspace == "../assets/img/img_not_found.png"){
                            photoEspace = "./../assets/img/taxon/default_icon_naturotheque.jpg";
                        }
                        else{
                            photoEspace = reponse[key]["image"];
                        }
  

                        // if (espece["_links"]["media"] !==  null) {
                        //     photoEspace = espece["_links"]["media"][0];
                        // } else {
                        //     photoEspace = "./../assets/img/taxon/default_icon_naturotheque.jpg";
                        // }

                        const a = document.createElement("div");
                        a.classList.add("grid-items");

                        a.innerHTML = `
                        <p>${nomEspace}</p>
                        `;
                        a.style.backgroundImage = `url(${photoEspace})`;
                        a.style.backgroundSize ="cover";
                        document.querySelector(".grille").appendChild(a);


                        // ex: espece["id"]
                        // ex: espece["_links"]["media"][0]
                    }
                }

                // console.log(reponse["data"][0][0]["_links"]["media"][0]);

            }
        };
        
        // Gestionnaire d'événement pour l'événement d'erreur
        xhr.onerror = function() {
            console.error("Erreur réseau lors de la requête.");
        };

        xhr.open("GET", url + params, true);
        xhr.send(null);
    }


    // AFFICHER LES LIKES
    else if (tabName === 'aime') {
        document.querySelector('.tab:nth-child(2)').classList.add('active');
        document.querySelector('.tab:nth-child(1)').classList.remove('active');


        document.querySelector(".grille").innerHTML = "";


        var params = 'controller=naturotheque&action=afficher_like' + '&email=' + email ;
        console.log(url  + params);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                 // document.getElementById('resultat').innerHTML = xhr.responseText;
                 var reponse = JSON.parse(xhr.responseText);
                 console.log(reponse);
 
                 for (const key in reponse) {
                     if (Object.hasOwnProperty.call(reponse, key)) {
                         console.log(reponse[key]);
                         let nomEspace = reponse[key]["nom"];
                         let photoEspace = reponse[key]["image"];

                         if (photoEspace == "../assets/img/img_not_found.png"){
                            photoEspace = "./../assets/img/taxon/default_icon_naturotheque.jpg";
                        }
                        else{
                            photoEspace = reponse[key]["image"];
                        }
  
 
                         // if (espece["_links"]["media"] !==  null) {
                         //     photoEspace = espece["_links"]["media"][0];
                         // } else {
                         //     photoEspace = "assets/img/ta./../xon/default_icon_naturotheque.jpg";
                         // }
 
                         const a = document.createElement("div");
                         a.classList.add("grid-items");
 
                         a.innerHTML = `
                         <p>${nomEspace}</p>
                         `;
                         a.style.backgroundImage = `url(${photoEspace})`;
                         a.style.backgroundSize ="cover";

                         document.querySelector(".grille").appendChild(a);
 
 
                         // ex: espece["id"]
                         // ex: espece["_links"]["media"][0]
                     }
                 }
 
                 // console.log(reponse["data"][0][0]["_links"]["media"][0]);
 
            }
        };
        
        // Gestionnaire d'événement pour l'événement d'erreur
        xhr.onerror = function() {
            console.error("Erreur réseau lors de la requête.");
        };

        xhr.open("GET", url + params, true);
        xhr.send(null);
    }
}



// Initialise le premier onglet comme actif au chargement de la page
window.onload = () => {
    selectTab('enregistre',document.getElementById("utilisateur").value);
};

