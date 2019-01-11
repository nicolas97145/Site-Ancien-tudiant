<?php 
    require_once('../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $_SESSION["page"] = "gestion";
    $select_comptes = ('Select * from bts');
    $query_select = $connexion->query($select_comptes);
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
            <a href="../frontoffice/accueil.php">Accueil</a> » Gestion des section de BTS
        </div>
        <div id="divPrincipal" class="box-principal">
            <h1>Création d'une section de BTS</h1>
            <form method="post" action="traitement/ajout_section.php">
				<input placeholder="ID (sigle) du secteur d'activité" name="idBTS" type="text" class="titre" required/>
                <input placeholder="Nom de la section de BTS" name="nomBts" type="text" class="titre" required/>
                <input class='bouton' type="submit" value="Créer la catégorie"/> 
            </form>
        </div>
        
        <div id="divPrincipal" class="box-principal">
            <h1>Modification d'une section de BTS</h1>
            <form method="post" action="traitement/modification_section.php">
                <p>Quelle section va être modifié ? </p>
                
                <select class="select" name="idbts">
                    <?php
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["id"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Modifier cette catégorie"/> 
            </form>
        </div>
        
        <div id="divPrincipal" class="box-principal">
            <h1>Suppression d'une section de BTS</h1>
            <form method="post" action="traitement/suppression_section.php">
                
                <p>Quelle section va être supprimée ?</p>
                
                <select class="select" name="id">
                    <?php
						$select_comptes = ('Select * from bts');
						$query_select = $connexion->query($select_comptes);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["id"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Supprimer cette catégorie"/>
            </form>
		</div>
    </body>
</html>