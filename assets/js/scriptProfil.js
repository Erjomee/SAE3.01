
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


        var params = 'controller=naturotheque&action=afficher_save' + '&email=' + email ;
        console.log(url  + params);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                // document.getElementById('resultat').innerHTML = xhr.responseText;
                console.log(xhr.responseText);
                // var reponse = JSON.parse(xhr.responseText);

                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                /////////////////    PAQUET SAVE //////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////


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

        var params = 'controller=naturotheque&action=afficher_like' + '&email=' + email ;
        console.log(url  + params);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                // document.getElementById('resultat').innerHTML = xhr.responseText;
                console.log(xhr.responseText);
                // var reponse = JSON.parse(xhr.responseText);

                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                /////////////////    PAQUET LIKE  //////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////
                ////////////////////////////////////////////////////

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

