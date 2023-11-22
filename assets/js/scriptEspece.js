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

//
//
// function more_info(): void{
//
//
//
//
// }