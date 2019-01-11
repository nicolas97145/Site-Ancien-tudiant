<?php
    session_start();
    require_once('../../frontoffice/connexionBD.php');
	$_SESSION["page"] = "gestion";
	if(! empty($_POST["idbts"]) and !empty($_POST["libellebts"]))
    {
		$idbts = $_POST["idbts"];
        $libellebts = $_POST["libellebts"];
		
		$update_bts= ("update bts set id='$idbts', libelleBTS='$libellebts' where id='$idbts'");
        $exec_update_bts = $connexion -> exec($update_bts);
		
		
	}
	
	if (!empty($_POST["idbts"])){
		$idbts = htmlentities($_POST["idbts"]);
	}

    $select_bts = ("Select * from bts where id = '$idbts'");
    $query_bts = $connexion->query($select_bts);
    $ligne_bts= $query_bts->fetch();
    
	
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
            <a href="../frontoffice/accueil.php">Accueil</a> » <a href="../choix_gestion_compte.php">Gestion des sections</a> » Modification de la section
        </div>
        <div class="box-principal">
            <form method="post" action="modification_section.php">
                    <h1>Informations de la section de BTS à modifier</h1>
                    
                    <div class="form-group">
                        <label for="login" class="col-md-3 control-label">ID</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_bts["id"] ?>" name="idbts">
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="login" class="col-md-3 control-label">Libelle</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php echo $ligne_bts["libelleBTS"] ?>" name="libellebts">
                        </div>
                    </div>
              
                    <input class='bouton' type="submit" value="Appliquer les modifications"/>
                    <br>
                    <a href="../choix_gestion_section.php"><input class='bouton' type="button" name="nom" value="Retourner à la gestion"></a>
            </form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
