
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
                        let id_espece = reponse[key]["id_espece"];


                        if (photoEspace == "../assets/img/img_not_found.png"){
                            photoEspace = "./../assets/img/taxon/default_icon_naturotheque.jpg";
                        }
                        else{
                            photoEspace = reponse[key]["image"];
                        }
  


                        const a = document.createElement("div");
                        a.classList.add("grid-items");

                        a.innerHTML = `
                        <pclass = "paragraphe">${nomEspace}</pclass>
                        `;
                        a.style.backgroundImage = `url(${photoEspace})`;
                        a.style.backgroundSize ="cover";

                        a.onclick = () => more_info(id_espece);

                        document.querySelector(".grille").appendChild(a);
                    
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
                        let id_espece = reponse[key]["id_espece"];


                         if (photoEspace == "../assets/img/img_not_found.png"){
                            photoEspace = "./../assets/img/taxon/default_icon_naturotheque.jpg";
                        }
                        else{
                            photoEspace = reponse[key]["image"];
                        }
  
 
                    
 
                         const a = document.createElement("div");
                         a.classList.add("grid-items");
 
                         a.innerHTML = `
                         <p class = "paragraphe">${nomEspace}</p>
                         `;
                         a.style.backgroundImage = `url(${photoEspace})`;
                         a.style.backgroundSize ="cover";

                         a.onclick = () => more_info(id_espece);


                         document.querySelector(".grille").appendChild(a);
 
 
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

