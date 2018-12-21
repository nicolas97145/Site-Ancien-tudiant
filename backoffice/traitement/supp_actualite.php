<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php 
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])) 
    {
        header('Location: authentification.php');
    }
    $idNews = htmlentities($_POST["idNews"]);
    // Select de toutes les infos de l'étudiant
    $del_news = $connexion->exec('DELETE from news where idNews = '.$idNews.';');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link rel="stylesheet" href="../../css/styleGestionCompte.css">
        <title>Gestion des actualités</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>    
        <aside><!-- Les à-cotés de la page --></aside>
        <article>
            <!-- Contenu textuel de la page -->
            <meta http-equiv="refresh" content="4;../choix_gestion_actualite.php" />
            <p id="rediriger">L'actualité a été correctement supprimé, vous allez être redirigé vers la page de gestion des actualités.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>
