<?php 
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $idNews = htmlentities($_POST["article_suppr"]);
    $select_informations = ("Select * from news where news.idNews= " . $idNews . ";");
    $query_select = $connexion->query($select_informations);
    $ligne = $query_select->fetch();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link rel="stylesheet" href="../../css/styleGestionActualite.css">
        <title>Gestion des actualités</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>      
        <div id="divPrincipal" class="box-principal">
            <form method="post" action="supp_actualite.php">
                    <h2>L'actualité suivante sera supprimée :</h2>
                    <input type="hidden" name="idNews" value="<?php echo $idNews ?>"/>
                    <label for="nom"><?php echo "Auteur : ".$ligne["auteur"]; ?></label><br>
                    <label for="prenom"><?php echo "Date : ".$ligne["date"]; ?></label><br>
                    <label for="dateN"><?php echo "Titre : ".$ligne["titre"]; ?></label><br>
                    <label for="login"><?php echo "Contenu : ".$ligne["contenu"]; ?></label><br>
                    <button>Supprimer cette actualitée</button>
                    <br>
                    <a href="../choix_gestion_compte.php"><input type="button" name="nom" class='bouton' value="Retourner à la gestion d'actualité"></a>
            </form>
	</div>
    </body>
</html>