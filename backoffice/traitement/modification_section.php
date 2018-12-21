<?php
    session_start();
    require_once('../../frontoffice/connexionBD.php');

    $id = htmlentities($_POST["id"]);


    $select_bts = ("Select * from bts where id = '$id'");
    $query_bts = $connexion->query($select_bts);
    $ligne_bts= $query_bts->fetch();
    
    $cache = $_POST['id'];
    echo $cache;

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
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » <a href="../choix_gestion_compte.php">Gestion des comptes</a> » Modification du compte
        </div>
        <div class="box-principal">
            <form method="post" action="modif_bts.php">
                    <h1>Informations de la section de BTS à modifier</h1>
                    
                    <p id="erreurtitre"></p>
                    <input placeholder="Sigle du BTS : <?php echo $ligne_bts["id"] ?>" name="idbts" type="text" class="titre" />
                    
                    
                    <input placeholder="Intitulé du BTS : <?php echo $ligne_bts["id"] ?>" name="libellebts" type="text" class="titre" />
                    
                    <input placeholder="caché <?php echo $cache?>" name="cache" type="text" class="titre" />
                    

                    <input class='bouton' type="submit" value="Appliquer les modifications"/>
                    <br>
                    <a href="../choix_gestion_section.php"><input class='bouton' type="button" name="nom" value="Retourner à la gestion"></a>
            </form>
	</div>
    </body>
</html>
