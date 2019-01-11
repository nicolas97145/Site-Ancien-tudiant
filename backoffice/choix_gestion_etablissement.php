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
            <a href="../frontoffice/accueil.php">Accueil</a> » Gestion des établissements
        </div>
        <div id="divPrincipal" class="box-principal">
            <h1>Création d'un établissement</h1>
            <form method="post" action="traitement/ajout_etablissement.php">
				<input placeholder="Nom de l'établissement" name="nameEtablissement" type="text" class="titre" required/>
                <input placeholder="Adresse de l'établissement" name="adresseEtablissement" type="text" class="titre" required/>
				<input placeholder="Code postal de de l'établissement" name="cpEtablissement" type="number" class="titre" required/>
                <input placeholder="Ville de l'établissement" name="villeEtablissement" type="text" class="titre" required/>
                <input class='bouton' type="submit" value="Créer l'établissement"/>           
            </form>
        </div>
        
        <div id="divPrincipal" class="box-principal">
            <h1>Modification d'un établissement</h1>
            <form method="post" action="traitement/modification_etablissement.php">
                <p>Quel établissement va être modifié?</p>
                <select class="select" name="id">
                    <?php
						$etablissement = ('Select * from etablissement');
						$query_select = $connexion->query($etablissement);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["nomEta"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Modifier cet établissement"/> 
            </form>
        </div>
        
        <div id="divPrincipal" class="box-principal">
            <form method="post" action="traitement/suppression_etablissement.php">
                <h1>Suppression d'un établissement</h1>
                <p>Quel établissement va être supprimé ?</p>
                <select class="select" name="id">
                    <?php
						$etablissement = ('Select * from etablissement');
						$query_select = $connexion->query($etablissement);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["nomEta"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Supprimer cet établissement"/>
            </form>
	   </div>
	   
	   <div id="divPrincipal" class="box-principal">
            <form method="post" action="traitement/fermer_etablissement.php">
                <h1>Fermeture d'un établissement</h1>
                <p>Quel établissement a fermé ?</p>
                <select class="select" name="id">
                    <?php
						$etablissement = ('Select * from etablissement where fermer = "Non"');
						$query_select = $connexion->query($etablissement);
                        while($lgn = $query_select->fetch())
                        {
                            echo '<option value="'.$lgn["id"].'">'.$lgn["nomEta"].'</option>';
                        }
                    ?>
                </select>
                <input class='bouton' type="submit" value="Fermer cet établissement"/>
            </form>
	</div>
    </body>
</html>