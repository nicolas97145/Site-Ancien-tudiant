<?php
    session_start();
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut']) or $_SESSION['statut']!="Admin")
    {
        header('Location: ../../frontoffice/authentification.php');
    }
    $id = htmlentities($_POST["id"]);

    $select_etudiant = ("Select * from etudiant where id = ".$id.";");
    $query_etudiant = $connexion->query($select_etudiant);
    $ligne_etudiant = $query_etudiant->fetch();

    $select_compte = ("Select * from typecompte where idcompte = ".$ligne_etudiant['idCompte'].";");
    $query_compte = $connexion->query($select_compte);
    $ligne_compte = $query_compte->fetch();

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
            <form method="post" action="modif_compte.php">
                    <h1>Informations du compte à modifier</h1>
                    <?php
                        if($ligne_compte["status"] != "Admin")
                        {
                            echo '<h2>Type du compte</h2>';
                            echo '<select class="select" name="status">';
                            $select_compte=$connexion->query("Select * from typecompte");
                            while($ligne=$select_compte->fetch()){
                                if($ligne_compte['idCompte']==$ligne['idCompte']){
                                    echo '<option value="'.$ligne['idCompte'].'" selected>'.$ligne['status'].'</option>';
                                }
                                else{
                                    echo '<option value="'.$ligne['idCompte'].'">'.$ligne['status'].'</option>';
                                }
                            }
                            echo '</select>';
                        }
                    ?>
                    <p id="erreurtitre"></p>
                    <input placeholder="Mail : <?php echo $ligne_etudiant["mail"] ?>" name="mail" type="text" class="titre" />
                    <?php
                        if($_SESSION["idEtudiant"] == $id)
                        {
                    ?>
                    <p id="erreurtitre"></p>
                    <input placeholder="Mot de passe" name="mdp" type="text" class="titre" />
                    <?php
                        }
                        if($ligne_compte["status"] == "Util")
                        {
                    ?>
                    <p id="erreurtitre"></p>
                    <input placeholder="Mot de passe" name="mdp" type="text" class="titre" />
                    <?php
                        }
                    ?>
                    <p id="erreurtitre"></p>
                    <input placeholder="Nom : <?php echo $ligne_etudiant["nom"] ?>" name="nom" type="text" class="titre" />

                    <p id="erreurtitre"></p>
                    <input placeholder="Prénom : <?php echo $ligne_etudiant["prenom"] ?>" name="prenom" type="text" class="titre" />

                    <p id="erreurtitre"></p>
                    <input value="<?php echo $ligne_etudiant["dateNaissance"] ?>" name="dateN" type="date" class="titre" />

                    <input name="id" type="hidden" value="<?php echo $id?>">

                    <input class='bouton' type="submit" value="Appliquer les modifications"/>
                    <br>
                    <a href="../choix_gestion_compte.php"><input class='bouton' type="button" name="nom" value="Retourner à la gestion"></a>
            </form>
	</div>
    </body>
</html>
