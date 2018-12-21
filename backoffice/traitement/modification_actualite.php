<?php
    require_once('../../frontoffice/connexionBD.php');
    if (empty($_SESSION['statut'])or $_SESSION['statut'] != "Admin") { //Si le statut est vide ou différent de admin 
        header('Location: ../frontoffice/authentification.php'); //On renvoie sur la page d'authentification
    }
    $idNews = htmlentities($_POST["article_modif"]);
    $select_informations = ("Select * from news where news.idNews= " . $idNews . ";");
    $query_select = $connexion->query($select_informations);
    $ligne = $query_select->fetch();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link rel="stylesheet" href="../../css/styleGestionActualite.css">
        <script type="text/javascript" src="../../ckeditor/ckeditor.js"></script><!-- Script pour l'outil d'édition de texte --> 
        <title>Gestion des actualités</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>      
        <div id="divPrincipal" class="box-principal">
            <form method="post" action="modif_actualite.php">
                <h2>Informations de l'actualité à modifier :</h2>
                <?php
                    echo '<p>Auteur</p>';
                    echo '<input name="auteur" type="auteur" class="titre" value = "' . $ligne["auteur"] . '" disabled>';
                    
                    echo '<p>Date</p>';
                    echo '<input name="date" type="date" class="titre"   value = "' . $ligne["date"] . '" disabled>';
                    
                    echo '<p>Titre</p>';
                    echo '<input name="titre" type="titre" class="titre" value = "' . $ligne["titre"] . '">';
                    
                    echo '<p>Catégorie</p>';
                    echo '<select id="type" name="type" class="select">';
                    echo '<option value="Lycée" selected>Lycée</option>';
                    echo '<option value="Mariage">Mariage</option>';
                    echo '<option value="Décés">Décés</option>';
                    echo '</select>';
                   
                    echo '<p>Contenu</p>';
                    echo '<textarea name="contenu" type="contenu" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" >'.$ligne["contenu"] .'</textarea>';
                ?>
                    <script type="text/javascript">
                    CKEDITOR.replace( 'contenu' );// Mise en place de l'outil d'édition de texte précédement appelé 
                    </script>
                <?php              
                    echo '<input name="idNews" type="hidden" value="' . $idNews . '">';
                ?>
                <br>
                <input id="voir" type="submit" class='bouton' value="Appliquer les modifications"/>
                <br>
                <a href="../choix_gestion_actualite.php"><input type="button" name="nom" class='bouton' value="Retourner à la gestion"></a>
            </form>
        </div>
    </body>
</html>

