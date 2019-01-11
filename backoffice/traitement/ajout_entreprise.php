<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    
    $nomEntreprise = html_entity_decode($_POST["nameEntreprise"]);
	$villeEntreprise = html_entity_decode($_POST["villeEntreprise"]);
	$idSecteur = html_entity_decode($_POST["id_secteur"]);
	$ferme = "Non";
    
	$selec_entreprise = ("select * from entreprise");
    $query_entreprise = $connexion->query($selec_entreprise); 
	 /*Création d'un nouvel id pour la catégorie*/
    $cpt = 1;
    $ok = true;
    while (($lgn_entreprise = $query_entreprise->fetch()) && ($ok == true)) { // Test les id existants
        if ($lgn_entreprise["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
            $ok = false;
        } else {
            $cpt = $cpt + 1;
        }
    }
    $id = $cpt;
    
    
  
	$insert_entreprise = ("Insert into entreprise values('$id', '$nomEntreprise' , '$villeEntreprise', '$idSecteur', '$ferme')");
	$exec_entreprise = $connexion->exec($insert_entreprise);
	
    
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
            <p id="message_envoye">Votre entreprise a bien été créée. Vous allez etre redirigé vers la page d'accueil dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>