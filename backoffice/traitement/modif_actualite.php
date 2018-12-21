<?php 
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    
    $idNews = html_entity_decode($_POST["idNews"]);
    $titre = html_entity_decode($_POST["titre"]);
    $type = html_entity_decode($_POST["type"]);
    $contenu = html_entity_decode($_POST["contenu"]);
    
    $update_news = $connexion->exec("UPDATE news 
        SET titre = '".$titre."', 
        categorie = '".$type."',
        contenu = '".$contenu."'
        WHERE idNews = ".$idNews.";");
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
        <div class="box-principal">
            <h1>Les modifications de l'actualité : </h1>
            <label for="statut"><?php echo "Titre : ".$titre; ?></label>
            <label for="nom"><?php echo "Catégorie : ".$type; ?></label>
            <label for="prenom"><?php echo "contenu : ".$contenu; ?></label>
            <a href="../choix_gestion_actualite.php"><input type="button" class='bouton' name="nom" value="Retourner à la gestion"></a>
	</div>
    </body>
</html>