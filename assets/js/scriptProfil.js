
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

    // const input = document.getElementById('changeImage');
    // if (input.files && input.files[0]) {
    //     const formData = new FormData();
    //     formData.append('image', input.files[0]);

    //     const xhr = new XMLHttpRequest();
    //     var url = 'frontController.php?';
    //     var params = 'controller=utilisateur&action=change_image'
        
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === 4) {
    //             if (xhr.status === 200) {
    //                 console.log('Image envoyée avec succès.');
    //                 location.reload();
    //             } else {
    //                 console.error('Erreur lors de l\'envoi de l\'image : ' + xhr.status);
    //             }
    //         }
    //     };
    //     xhr.open('POST', url + params, true);
    //     xhr.send(formData);
    // }
}
