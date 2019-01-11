<?php 
    require_once('../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $_SESSION["page"] = "gestion";
    $select_activite = ('Select * from secteuractivite');
    $query_select = $connexion->query($select_activite);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleGestionCompte.css">
        <title>Gestion anciens étudiants</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?> 
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Gestion des secteurs d'activités
        </div>
        <div id="divPrincipal" class="box-principal">
            <h1>Création d'un secteur</h1>
            <form method="post" action="traitement/ajout_secteur.php">
                <input placeholder="Nom du secteur d'activité" name="nomSecteur" type="text" class="titre" required/>
                <input class='bouton' type="submit" value="Créer le secteur"/> 
            </form>
        </div>
        
        <div id="divPrincipal" class="box-principal">
            <h1>Modification d'un secteur</h1>
            <form method="post" action="traitement/modification_secteur.php">
                <p>Quel secteur va être modifié?</p>
                <select class="select" name="id">
                    <?php
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["libelle"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Modifier ce secteur"/> 
            </form>
        </div>
        
        <div id="divPrincipal" class="box-principal">
            <form method="post" action="traitement/suppression_secteur.php">
                <h1>Suppression d'un secteur</h1>
                <p>Quel secteur va être supprimé ?</p>
                <select class="select" name="id">
                    <?php
						$select_activite = ('Select * from secteuractivite');
						$query_select = $connexion->query($select_activite);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["libelle"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Supprimer ce secteur"/>
            </form>
	</div>
    </body>
</html>