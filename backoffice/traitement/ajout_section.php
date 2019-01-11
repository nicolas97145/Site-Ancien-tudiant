<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    
    $nomBts = html_entity_decode($_POST["nomBts"]);
	$idBts = html_entity_decode($_POST["idBTS"]);
    
    $selec_bts = ("select * from bts");
    $query_bts = $connexion->query($selec_bts);  
    $existant = false;
	
	
    while ($lgn_bts = $query_bts->fetch()) { // Test les id existants
        if ($lgn_bts["id"] == $idBts ) {// Si l'id testé existe déjà
            $existant = true;
        } 
    }
    
    
    if ($existant){
		header('Location: ../choix_gestion_section.php');
	}else{
		$insert_bts = ("Insert into bts values('$idBts', '$nomBts')");
		$exec_bts = $connexion->exec($insert_bts);
	}
    
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
            <p id="message_envoye">Votre section a bien été créée. Vous allez etre redirigé vers la page d'accueil dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>