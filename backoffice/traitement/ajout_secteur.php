<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    
    $nomSecteur = html_entity_decode($_POST["nomSecteur"]);
    
    $selec_secteur = ("select * from secteuractivite");
    $query_secteur = $connexion->query($selec_secteur);
    
    /*Création d'un nouvel id pour la catégorie*/
    $cpt = 1;
    $ok = true;
    while (($lgn_secteur = $query_secteur->fetch()) && ($ok == true)) { // Test les id existants
        if ($lgn_secteur["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
            $ok = false;
        } else {
            $cpt = $cpt + 1;
        }
    }
    $id = $cpt;
    
    
    $insert_secteur = ("Insert into secteuractivite values($id, '$nomSecteur')");
    $exec_secteur = $connexion->exec($insert_secteur);
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
            <meta http-equiv="refresh" content="2;../../frontoffice/accueil.php" />
            <p id="message_envoye">Votre secteur a bien été créé. Vous allez etre redirigé vers la page d'accueil dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>