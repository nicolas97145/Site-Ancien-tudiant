<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    
    $nomEtablissement = html_entity_decode($_POST["nameEtablissement"]);
	$adresseEtablissement = html_entity_decode($_POST["adresseEtablissement"]);
	$cpEtablissement = html_entity_decode($_POST["cpEtablissement"]);
	$villeEtablissement = html_entity_decode($_POST["villeEtablissement"]);
	$fermer= "Non";
    
    $selec_etablissement = ("select * from etablissement");
    $query_etablissement = $connexion->query($selec_etablissement);
    
    /*Création d'un nouvel id pour l'etablissement*/
    $cpt = 1;
    $ok = true;
    while (($lgn_etablissement = $query_etablissement->fetch()) && ($ok == true)) { // Test les id existants
        if ($lgn_etablissement["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
            $ok = false;
        } else {
            $cpt = $cpt + 1;
        }
    }
    $id = $cpt;
    
    
	$insert_etablissement = ("Insert into etablissement values('$id', '$nomEtablissement' , '$adresseEtablissement', '$cpEtablissement' , '$villeEtablissement', '$fermer')");
	$exec_etablissement = $connexion->exec($insert_etablissement);
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
            <p id="message_envoye">Votre établissement a bien été créé. Vous allez etre redirigé vers la page d'accueil dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>