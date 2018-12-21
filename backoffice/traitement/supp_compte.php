<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut']))
    {
        header('Location: authentification.php');
    }
    $id = htmlentities($_POST["id"]);

    $del_passage = $connexion->exec("DELETE from passage where id =".$id.";");

    $del_stage = $connexion->exec("DELETE from stage where id =".$id.";");

    $del_etudier = $connexion->exec("DELETE from etudier where id =".$id.";");

    $del_job = $connexion->exec("DELETE from job where id =".$id.";");

    $del_etudiant = $connexion->exec("DELETE from etudiant where id = ".$id.";");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link rel="stylesheet" href="../../css/styleGestionCompte.css">
        <title>Gestion anciens étudiants</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <aside><!-- Les à-cotés de la page --></aside>
        <article>
            <!-- Contenu textuel de la page
            <meta http-equiv="refresh" content="4;../choix_gestion_compte.php" />-->
            <p id="rediriger">Le compte a été correctement supprimé, vous allez être redirigé vers la page de gestion des comptes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>
