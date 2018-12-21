<?php
    session_start();
    if(empty($_SESSION['statut']))
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "boitereception";
    require_once('connexionBD.php');

    $selectMail=$connexion->query("SELECT m.id, m.sujet, e.nom, e.prenom, e.id as 'idetudiant' FROM mail m, etudiant e WHERE m.id_etudiant_receveur = ".$_SESSION['idEtudiant']." and e.id = m.id_etudiant_envoyeur");
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
            <a href="accueil.php">Accueil</a> » Mail
        </div>

        <div class="box-principal">
            <table>
                <tr>
                    <td>Sujet</td>
                    <td>Nom</td>
                </tr>
                <?php
                    while($ligne=$selectMail->fetch()){
                        echo "<tr>";
                        echo "<td><a href='boite_reception_message.php?id=".$ligne['id']."'>".$ligne['sujet']."</a></td>";
                        echo "<td><a href='affiche_profil.php?id=".$ligne['idetudiant']."'>".$ligne['nom']." ".$ligne['prenom']."</a></td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
