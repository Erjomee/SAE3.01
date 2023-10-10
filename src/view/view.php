<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" href="./../assets/css/style.css">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <a href="frontController.php?action=readAll"><li>Accueil</li></a>
                    <a href="frontController.php?action=readAll&controller=utilisateur"><li>Page d'accueil utilisateur</li></a>
                    <a href="frontController.php?action=readAll&controller=trajet"><li>Page d'accueil trajet</li></a>
                </ul>
            </nav>
        </header>
        <hr>
        <main>
            <?php
            require __DIR__ . "/{$cheminVueBody}";
            ?>
        </main>
        <hr>
        <footer>
            <p>
                Site de covoiturage de Jérome
            </p>
        </footer>
    </body>
</html>
