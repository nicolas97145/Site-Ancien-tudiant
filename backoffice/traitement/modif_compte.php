<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin")
    {
        header('Location: ../frontoffice/authentification.php');
    }

    $id = htmlentities($_POST["id"]);
    $statut = 1;
    if(isset($_POST["status"])){
        $statut = htmlentities($_POST["status"]);
    }
    if((isset($_POST["mail"])) && (strlen(trim($_POST["mail"])) > 0))
    {
        $mail = htmlentities($_POST["mail"]);
    }
    else
    {
        $select_mail = $connexion->query("Select mail from etudiant where id =".$id.";");
        $ligne = $select_mail->fetch();
        $mail = $ligne["mail"];
    }

    if((isset($_POST["mdp"])) && (strlen(trim($_POST["mdp"])) > 0))
    {
        $mdp = htmlentities($_POST["mdp"]);
        $change_mdp = 1;
    }
    else
    {
        $mdp = "Non changé";
        $change_mdp = 0;
    }

    if((isset($_POST["nom"])) && (strlen(trim($_POST["nom"])) > 0))
    {
        $nom = htmlentities($_POST["nom"]);
    }
    else
    {
        $select_nom = $connexion->query("Select nom from etudiant where id =".$id.";");
        $ligne = $select_nom->fetch();
        $nom = $ligne["nom"];
    }

    if((isset($_POST["prenom"])) && (strlen(trim($_POST["prenom"])) > 0))
    {
        $prenom = htmlentities($_POST["prenom"]);
    }
    else
    {
        $select_prenom = $connexion->query("Select prenom from etudiant where id =".$id.";");
        $ligne = $select_prenom->fetch();
        $prenom = $ligne["prenom"];
    }

    if((isset($_POST["dateN"])) && (strlen(trim($_POST["dateN"])) > 0))
    {
        $dateN = htmlentities($_POST["dateN"]);
    }
    else
    {
        $select_dateN = $connexion->query("Select dateNaissance from etudiant where id =".$id.";");
        $ligne = $select_dateN->fetch();
        $dateN = $ligne["dateNaissance"];
    }
    if($change_mdp == 1)
    {
        $update_compte = $connexion->exec("UPDATE etudiant
            SET password = '".MD5($mdp)."'
            WHERE id = ".$id.";");
    }
    $update_etudiant = $connexion->exec("UPDATE etudiant
            SET nom = '".$nom."',
            idCompte = '".$statut."',
            mail = '".$mail."',
            prenom = '".$prenom."',
            dateNaissance = '".$dateN."'
            WHERE id = ".$id.";");
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
        <div class="box-gestion">
            <h1>Les modifications du compte</h1>
            <label><span class="recap">Statut : </span><?php
            $checkStatus=$connexion->query('Select * from typecompte where idCompte = '.$statut);
            $l=$checkStatus->fetch();
            echo $l['status'];
            ?></label>
            <label><span class="recap">Nom : </span><?php echo $nom; ?></label>
            <label><span class="recap">Prénom : </span><?php echo $prenom; ?></label>
            <label><span class="recap">Date de naissance : </span><?php echo $dateN; ?></label>
            <label><span class="recap">Identifiant : </span><?php echo $mail; ?></label>
            <label><span class="recap">Mot de passe : </span><?php echo $mdp; ?></label>
            <a href="../choix_gestion_compte.php"><input class='bouton' type="button" name="nom" value="Retourner à la gestion"></a>
	</div>
    </body>
</html>
