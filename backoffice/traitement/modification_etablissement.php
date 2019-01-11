<?php
    session_start();
    require_once('../../frontoffice/connexionBD.php');
	
	if(!empty($_POST["nomEta"]) && !empty($_POST["villeEta"]) )
    {
		$id = $_POST["id"];
        $nomE = $_POST["nomEta"];
		$adresse = $_POST["adresseEta"];
        $cp = $_POST["cpEta"];
		$ville = $_POST["villeEta"];
		
		$update_etablissement= ("update etablissement set nomEta='$nomE', adresse='$adresse', cp = '$cp', ville = '$ville' where id='$id'");
        $exec_update_etablissement = $connexion -> exec($update_etablissement);
		
		
	}
	
	if (!empty($_POST["id"])){
		$id = htmlentities($_POST["id"]);
	}

    $select_etablissement = ("Select * from etablissement where id = '$id'");
    $query_etablissement = $connexion->query($select_etablissement);
    $ligne_etablissement= $query_etablissement->fetch();
    
	
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
            <a href="../frontoffice/accueil.php">Accueil</a> » <a href="../choix_gestion_etablissement.php">Gestion des établissements</a> » Modification de l'établissement
        </div>
        <div class="box-principal">
            <form method="post" action="modification_etablissement.php">
                    <h1>Informations de l'établissement à modifier</h1>
					
					<div class="form-group">
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" value="<?php echo $ligne_etablissement["id"] ?>" name="id">
                        </div>
                    </div>
              
					<div class="form-group">
					<label for="login" class="col-md-3 control-label">Nom de l'établissement</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_etablissement["nomEta"] ?>" name="nomEta">
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="login" class="col-md-3 control-label">Adresse</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_etablissement["adresse"] ?>" name="adresseEta">
                        </div>
                    </div>
					
					<div class="form-group">
					<label for="login" class="col-md-3 control-label">Code postal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_etablissement["cp"] ?>" name="cpEta">
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="login" class="col-md-3 control-label">Ville</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_etablissement["ville"] ?>" name="villeEta">
                        </div>
                    </div>
					
                    <input class='bouton' type="submit" value="Appliquer les modifications"/>
                    <br>
                    <a href="../choix_gestion_etablissement.php"><input class='bouton' type="button" name="nom" value="Retourner à la gestion"></a>
            </form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>