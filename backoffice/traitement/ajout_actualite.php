<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin")//Si le statut est vide ou différent de admin
    {
        header('Location: ../frontoffice/authentification.php');//On renvoie sur la page d'authentification
    }
    $categorie = htmlentities($_POST["categorie"]);
    $idCompte = $_SESSION["idCompte"];
    $select_auteur = $connexion->query('Select nom, prenom from etudiant where id='.$idCompte.';');
    $auteur = $select_auteur->fetch();
    $auteur = $auteur["nom"]." ".$auteur['prenom'];
    $date = date("Y-m-d");
    // $ok vaut 1 si tous les test sont ok
    // sinon il sera passé à 0 et l'ajout ne sera pas effectué
    $ok = 1;
    //test des variables
    if((isset($_POST["titre"])) && (strlen(trim($_POST["titre"])) > 0))
    {
        $titre = htmlentities($_POST["titre"]);
    }
    else
    {
        $titre = "Il faut renseigner un titre.";
        $ok = 0;
    }

    if((isset($_POST["contenu"])) && (strlen(trim($_POST["contenu"])) > 0))
    {
        $contenu = htmlentities($_POST["contenu"]);
    }
    else
    {
        $contenu = "Il faut renseigner du contenu.";
        $ok = 0;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link rel="stylesheet" href="../../css/styleGestionCompte.css">
        <title></title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <div class="box-principal">
            <?php
            if($ok == 0)
            {
                echo "<h1>L'actualité n'a pas été créé :</h1>";
            }
            else
            {
                echo "<h1>Actualité créé :</h1>";
            }
            ?>
            <label for="auteur"><?php echo "Auteur : ".$auteur; ?></label>
            <label for="date"><?php echo "Date : ".$date; ?></label>
            <label for="titre"><?php echo "Titre : ".$titre; ?></label>
            <label for="cat"><?php echo "Catégorie de l'actualité : ".$categorie; ?></label>
            <label for="contenu"><?php echo "Contenu : ".$contenu; ?></label>
            <a href="../choix_gestion_actualite.php"><input type="button" name="nom" class='bouton' value="Ajouter l'actualité"></a>
	</div>
    </body>
</html>

<?php
    if($ok == 1)//Donc toute les variables existent
    {
        $selectid = $connexion->query('Select * from news');

        $nbr = $selectid ->rowCount();
        if ($nbr == 0)
        {
            $id = 0;
        }
        else
        {
            while($lgnid = $selectid->fetch()) // Créé un nouvel id pour l'actualité
            {
                $id = $lgnid["idNews"];
            }

        }
        $id = $id + 1;

        // Affectation de la catégorie correspondant à la base de données

        $ajout_actualite = ('INSERT INTO news VALUES ("'.$id.'","'.$categorie.'","'.$auteur.'","'.$titre.'","'.$contenu.'", "'.$date.'")');
        $exec_actualite = $connexion->exec($ajout_actualite);

        /*$ajout_etud = ('INSERT INTO etudiant VALUES ("'.$id.'","'.$nom.'", "'.$prenom.'", "'.$dateN.'", null, null)');
        $exec_etud = $connexion->exec($ajout_etud);*/
    }
?>
