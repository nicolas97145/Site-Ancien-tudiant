<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }

    $id = html_entity_decode($_POST["id"]);
    
    $delete_bts = ("delete from bts where id = $id");
    $exec_delete = $connexion->exec($delete_bts);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css">
        <title></title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>    
        <aside><!-- Les à-cotés de la page --></aside>
        <article>
            <!-- Contenu textuel de la page -->
            <meta http-equiv="refresh" content="4;../../frontoffice/accueil.php" />
            <p id="message_envoye">Votre section a bien été supprimé. Vous allez etre redirigé vers la page d'accueil dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>