<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }

    $id = html_entity_decode($_POST["id"]);
    
    $delete_secteur = ("delete from secteuractivite where id = '$id'");
    $exec_delete = $connexion->exec($delete_secteur);
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
            <meta http-equiv="refresh" content="2;../choix_gestion_secteuractivite.php" />
            <p id="message_envoye">Votre secteur a bien été supprimé. Vous allez etre redirigé vers la page de gestion des secteurs d'activités dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>