<?php
    session_start();
    if(empty($_SESSION['statut']))
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "accueil";

    require_once('connexionBD.php');

    $idEtudiant = htmlentities($_GET["id"]);

    $select_etudiant = ("SELECT * FROM etudiant WHERE id = '$idEtudiant'");
    $query_etudiant = $connexion->query($select_etudiant);
    $lgn_etudiant = $query_etudiant->fetch();

    $select_admin = $connexion->query("SELECT t.status FROM etudiant e, typecompte t WHERE e.id = ".$_SESSION['idEtudiant']." and e.idCompte = t.idCompte");
    $get_admin=$select_admin->fetch();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleAccueil.css" />
        <link rel="stylesheet" href="../css/styleActualite.css" />
        <title></title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="accueil.php">Accueil</a> » Profil de <?php echo $lgn_etudiant["nom"]." ".$lgn_etudiant["prenom"] ?>
        </div>

        <div class="box-principal">
            <h1>
                <?php
                    echo "Profil de : ".$lgn_etudiant["nom"]." ".$lgn_etudiant["prenom"];
                ?>
            </h1>
            <div id='divSecondaire' class='box-Secondaire'>
                <?php
                if($get_admin['status']=="Admin"){
                    echo "<a href='contact_etudiant.php?id=".$lgn_etudiant['id']."'>Contacter</a><br>";
                }
                echo "Date de naissance : ".$lgn_etudiant["dateNaissance"]."<br>";
                echo "mail : ".$lgn_etudiant["mail"];
                echo "<h2>Stage</h2>";
                $select_stage=$connexion->query("SELECT s.dateDebut, s.dateFin, s.objectifDuStage, n.nomEnt from etudiant e, stage s, entreprise n, secteuractivite a WHERE e.id = s.id AND s.id_entreprise = n.id AND n.id_secteurActivite = a.id AND e.id = $idEtudiant");
                echo "<table>";
                echo "<tr>";
                echo "<td>Date de début</td>";
                echo "<td>Date de fin</td>";
                echo "<td>Entreprise</td>";
                echo "<td>Objectif du stage</td>";
                echo "</tr>";
                while($ligne=$select_stage->fetch()){
                  echo "<tr>";
                  echo "<td>".$ligne['dateDebut']."</td>";
                  echo "<td>".$ligne['dateFin']."</td>";
                  echo "<td>".$ligne['nomEnt']."</td>";
                  echo "<td>".$ligne['objectifDuStage']."</td>";
                  echo "</tr>";
                }
                echo "</table>";
                echo "<h2>Parcours professionnel</h2>";
                $select_job=$connexion->query("SELECT s.dateDebut, s.dateFin, n.nomEnt, p.libelle as 'Emploi' from etudiant e, job s, entreprise n, secteuractivite a, emploi p WHERE e.id = s.id AND s.id_entreprise = n.id AND n.id_secteurActivite = a.id AND e.id = $idEtudiant AND p.id = s.id_emploi");
                echo "<table>";
                echo "<tr>";
                echo "<td>Date de début</td>";
                echo "<td>Date de fin</td>";
                echo "<td>Entreprise</td>";
                echo "<td>Type d'emploi</td>";
                echo "</tr>";
                while($ligne=$select_job->fetch()){
                  echo "<tr>";
                  echo "<td>".$ligne['dateDebut']."</td>";
                  echo "<td>".$ligne['dateFin']."</td>";
                  echo "<td>".$ligne['nomEnt']."</td>";
                  echo "<td>".$ligne['Emploi']."</td>";
                  echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>
        </div>
    </body>
</html>
