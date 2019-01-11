<?php 
    require_once('../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $_SESSION["page"] = "gestion";
   
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
            <a href="../frontoffice/accueil.php">Accueil</a> » Gestion des entreprises
        </div>
        <div id="divPrincipal" class="box-principal">
            <h1>Création d'une entreprise</h1>
            <form method="post" action="traitement/ajout_entreprise.php">
				<input placeholder="Nom de l'entreprise" name="nameEntreprise" type="text" class="titre" required/>
                <input placeholder="Ville de l'entreprise" name="villeEntreprise" type="text" class="titre" required/>
				<label> Choix du secteur d'activité de l'entreprise</label>
				<select class="select" name="id_secteur">
                    <?php
						$select_secteur = ('Select * from secteuractivite');
						$query_select = $connexion->query($select_secteur);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["libelle"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Créer l'entreprise"/>           
            </form>
        </div>
        
        <div id="divPrincipal" class="box-principal">
            <h1>Modification d'une entreprise</h1>
            <form method="post" action="traitement/modification_entreprise.php">
                <p>Quelle entreprise va être modifiée?</p>
                <select class="select" name="id">
                    <?php
						$select_entreprise = ('Select * from entreprise');
						$query_select = $connexion->query($select_entreprise);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["nomEnt"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Modifier cette entreprise"/> 
            </form>
        </div>
        
		 <div id="divPrincipal" class="box-principal">
            <form method="post" action="traitement/suppression_entreprise.php">
                <h1>Suppression d'une entreprise</h1>
                <p>Quelle entreprise va être supprimée ?</p>
                <select class="select" name="id">
                    <?php
						$select_entreprise = ('Select * from entreprise');
						$query_select = $connexion->query($select_entreprise);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["nomEnt"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Supprimer cette entreprise"/>
            </form>
	   </div>
	   
        <div id="divPrincipal" class="box-principal">
            <form method="post" action="traitement/fermer_entreprise.php">
                <h1>Fermeture d'une entreprise</h1>
                <p>Quelle entreprise a fermée ?</p>
                <select class="select" name="id">
                    <?php
						$select_entreprise = ('Select * from entreprise where fermer = "Non"');
						$query_select = $connexion->query($select_entreprise);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["nomEnt"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Fermer cette entreprise"/>
            </form>
	</div>
    </body>
</html>