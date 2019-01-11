<?php
    session_start();
    require_once('../../frontoffice/connexionBD.php');
	
	if(!empty($_POST["nomEntreprise"]) && !empty($_POST["villeEntreprise"]) )
    {
		$id = $_POST["id"];
		$id_secteur = $_POST["id_secteur"];
        $nomE = $_POST["nomEntreprise"];
		$villeE = $_POST["villeEntreprise"];
		
		$update_entreprise= ("update entreprise set nomEnt='$nomE', villeEnt = '$villeE' , id_secteurActivite = '$id_secteur' where id='$id'");
        $exec_update_entreprise = $connexion -> exec($update_entreprise);
		
		
	}
	
	if (!empty($_POST["id"])){
		$id = htmlentities($_POST["id"]);
	}

    $select_entreprise = ("Select * from entreprise where id = '$id'");
    $query_entreprise = $connexion->query($select_entreprise);
    $ligne_entreprise= $query_entreprise->fetch();
    
	
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link rel="stylesheet" href="../../css/styleGestionCompte.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <title>Gestion anciens étudiants</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » <a href="../choix_gestion_entreprise.php">Gestion des entreprises</a> » Modification de l'entreprise
        </div>
        <div class="box-principal">
            <form method="post" action="modification_entreprise.php">
                    <h1>Informations de l'entreprise à modifier</h1>
					
					<div class="form-group">
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" value="<?php echo $ligne_entreprise["id"] ?>" name="id">
                        </div>
                    </div>
              
					<div class="form-group">
					<label for="login" class="col-md-3 control-label">Nom de l'entreprise</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_entreprise["nomEnt"] ?>" name="nomEntreprise">
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="login" class="col-md-3 control-label">Ville</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_entreprise["villeEnt"] ?>" name="villeEntreprise">
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="login" class="col-md-3 control-label">Secteur d'activité</label>
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
                    </div>
					
                    <input class='bouton' type="submit" value="Appliquer les modifications"/>
                    <br>
                    <a href="../choix_gestion_entreprise.php"><input class='bouton' type="button" name="nom" value="Retourner à la gestion"></a>
            </form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>