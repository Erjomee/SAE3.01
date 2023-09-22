<?php 
    session_start() ;
    var_dump($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<p>Connecté sur <?php  echo $_SESSION['user']['nom'] .' '. $_SESSION['user']['prenom'] ;?></p>

    
</body>
</html>