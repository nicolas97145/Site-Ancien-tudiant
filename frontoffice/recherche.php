<?php
    session_start();
    if(empty($_SESSION['statut']))
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $_SESSION["page"] = "recherche";
    require_once('../frontoffice/connexionBD.php');
    /*Récupération des entreprises*/
    $select_entreprises = ('Select * from entreprise');
    $query_select_entreprise = $connexion->query($select_entreprises);
    /*Récupération des bts */
    $select_bts = ('Select * from bts');
    $query_bts = $connexion->query($select_bts);
    /*Recherche des etablissement */
    $select_etablissement = ('Select * from etablissement');
    $query_etablissement = $connexion->query($select_etablissement);
    /*Recherche des années de promotion */
    $select_promo = ("Select distinct year(anneeSortie) as 'annee' from passage");
    $query_promo = $connexion->query($select_promo);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleRecherche.css"/>
        <title>Gestion anciens étudiants</title>
        <script type="text/javascript" src="../js/gestion_recherche.js"></script>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Recherche
        </div>
        <div class="box-principal">
            <form action="" method="POST">
                <div id="radiobutton">
		    <div id="content-radiobutton">
		    	<div class="radio">	
                       	    <input type="radio" name="radiobutton" value="recherche-select-entreprise" checked>Recherche d'entreprise<br>
		    	</div>
		    	<div class="radio">
                    	    <input type="radio" name="radiobutton" value="recherche-select-bts">Rechercher par section de BTS<br>
		    	</div>
		    	<div class="radio">
                    	    <input type="radio" name="radiobutton" value="recherche-select-etablissement">Rechercher par Etablissement<br>
		    	</div>
		    	<div class="radio">
                    	    <input type="radio" name="radiobutton" value="recherche-select-promo">Rechercher par Année de promotion<br>
		    	</div>
		    	<div class="radio">
                    	    <input type="radio" name="radiobutton" value="recherche-select-nom">Rechercher par eleve de BTS<br>
                    	</div>
		    </div>
		    <div id="" class="recherche-header" onclick="selectitem();">Valider</div>
                </div>
                <div id="optionrecherche"  style="display:none;">
                    <div id="optioninput">
                        <select id="recherche-select-entreprise" class="select" name="id" hidden>
                            <?php
                                while($ligne_ent = $query_select_entreprise->fetch())
                                {
                                    echo '<option value="'.$ligne_ent["id"].'">'.$ligne_ent["nomEnt"].'</option>';
                                }
                            ?>
                        </select>
                        <select id="recherche-select-bts" class="select" name="id" hidden>
                            <?php
                                while($ligne_bts = $query_bts->fetch())
                                {
                                    echo '<option value="'.$ligne_bts["id"].'">'.$ligne_bts["libelleBTS"].'</option>';
                                }
                            ?>
                        </select>
                        <input id="recherche-select-nom" class="input" type="text" name="id" hidden/>
                        <select id="recherche-select-etablissement" class="select" name="id" hidden>
                            <?php
                                while($ligne_bts = $query_etablissement->fetch())
                                {
                                    echo '<option value="'.$ligne_bts["id"].'">'.$ligne_bts["nomEta"].'</option>';
                                }
                            ?>
                        </select>
                        <select id="recherche-select-promo" class="select" name="id" hidden>
                          <?php
                            while($ligne = $query_promo->fetch())
                            {
                              echo '<option value="'.$ligne['annee'].'">'.$ligne['annee'].'</option>';
                            }
                           ?>
                        </select>
                        <!-- Les éléments à cacher rendu visible en JS -->
                    </div>
                    <div class="recherche-header" onclick="lanceRecherche();">Lancer la recherche</div>
                </div>
                <div id="contentrecherche" style="display:none;">
                    <!-- Résultat de la recherche -->
                </div>
            </form>
        </div>
    </body>
</html>
