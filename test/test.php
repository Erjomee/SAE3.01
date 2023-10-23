<?php
$url = 'https://taxref.mnhn.fr/api/taxa/search?version=16.0&frenchVernacularNames=pinson&page=1&size=5000';

$ch = curl_init($url);

// Désactiver la vérification du certificat SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Erreur cURL : ' . curl_error($ch);
}

curl_close($ch);

if ($response !== false) {
    $data = json_decode($response, true);

    $id = $data['_embedded']['taxa'][0]['id'];
    echo $id;

} else {
    echo 'La requête a échoué.';
}
?>
