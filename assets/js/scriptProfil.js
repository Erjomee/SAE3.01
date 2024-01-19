
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
    document.getElementById("myForm").submit();
}