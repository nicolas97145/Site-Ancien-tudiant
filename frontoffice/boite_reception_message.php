<?php
    session_start();
    if(empty($_SESSION['statut'])||!isset($_GET['id'])||empty($_GET['id']))
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "boitereception";
    require_once('connexionBD.php');

    $selectMail=$connexion->query("SELECT m.id, m.sujet, e.nom, e.prenom, e.id as 'idetudiant', m.message FROM mail m, etudiant e WHERE m.id = ".$_GET['id']." and e.id = m.id_etudiant_envoyeur");
    $getMail=$selectMail->fetch();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <title>Mail</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="accueil.php">Accueil</a> » <a href="boite_reception.php"> Mail </a> » <?php echo $getMail['sujet']; ?>
        </div>

        <div class="box-principal">
            From :<a href="affiche_profil.php?id=<?php echo $getMail['idetudiant']; ?>"><?php echo $getMail['nom']." ".$getMail['prenom']; ?></a><br>
            Sujet :<?php echo $getMail['sujet']; ?><br>
            Message :<?php echo $getMail['message']; ?><br>
        </div>

        <div class="box-principal">
            <a href="contact_etudiant.php?id=<?php echo $getMail['idetudiant']; ?>"><div class="recherche-header">Répondre</div></a>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
