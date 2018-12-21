<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    
    $nomBts = html_entity_decode($_POST["nomBts"]);
    
    $selec_bts = ("select * from bts");
    $query_bts = $connexion->query($selec_bts);
    
    /*Création d'un nouvel id pour la catégorie*/
    $cpt = 1;
    $ok = true;
    while (($lgn_bts = $query_bts->fetch()) && ($ok == true)) { // Test les id existants
        if ($lgn_bts["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
            $ok = false;
        } else {
            $cpt = $cpt + 1;
        }
    }
    $id = $cpt;
    
    
    $insert_bts = ("Insert into bts values($id, '$nomBts')");
    $exec_bts = $connexion->exec($insert_bts);
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
            <p id="message_envoye">Votre section a bien été créée. Vous allez etre redirigé vers la page d'accueil dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>