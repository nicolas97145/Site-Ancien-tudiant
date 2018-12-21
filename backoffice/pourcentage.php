<?php
    require_once('../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut']) or $_SESSION['statut']!="Admin")
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "pourcentage";
?>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <!--<script type="text/javascript" src="../js/verification_contact.js"></script>-->
      <title>Voir les pourcentages</title>
      <script type="text/javascript" src="../js/cercle.js"></script>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../css/stylePourcentage.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Pourcentage
        </div>
        <?php
            $recup_etudiants=$connexion->query("SELECT count(*) as 'TOTAL' FROM etudiant e, typecompte a WHERE a.idcompte = e.idcompte AND a.status = 'Util'");
            $ligne_etudiants=$recup_etudiants->fetch();

            $recup_etudiant_scolariser=$connexion->query("SELECT count(*) as 'TOTAL' FROM etudiant e, etudier t, typecompte a WHERE e.id = t.id AND a.idcompte = e.idcompte AND a.status = 'Util'");
            $ligne_etudiant_scolariser=$recup_etudiant_scolariser->fetch();
            if($ligne_etudiants['TOTAL']!=0||$ligne_etudiant_scolariser['TOTAL']!=0){
              $etudiant_etude_pourcentage=floor(($ligne_etudiant_scolariser['TOTAL']*100)/$ligne_etudiants['TOTAL']);
              $etudiant_professionnel_pourcentage=100-$etudiant_etude_pourcentage;
            }
            else{
              $etudiant_etude_pourcentage=0;
              $etudiant_professionnel_pourcentage=0;
            }
        ?>
        <div class="box-contact">
            <h1>Pourcentage de poursuite d'étude</h1>
            Nombre d'étudiant : <?php echo $ligne_etudiants['TOTAL']; ?>
            <br>Pourcentage d'élève ayant fait des poursuites d'études : <?php echo $etudiant_etude_pourcentage."%"; ?>
            <br>Pourcentage d'élève n'ayant pas fait de poursuite d'étude : <?php echo $etudiant_professionnel_pourcentage."%"; ?>
            <ul class="graph-vertical">
                <li>
                    <span>Poursuites d'études</span>
                    <span style="height: <?php echo $etudiant_etude_pourcentage/10;?>rem;">
                        <span class="cover">&nbsp; </span>
                        <?php echo $etudiant_etude_pourcentage."%"; ?>
                    </span>
                </li>
                <li>
                    <span>Poursuites professionnel</span>
                    <span style="height: <?php echo $etudiant_professionnel_pourcentage/10;?>rem;">
                        <span class="cover">&nbsp; </span>
                        <?php echo $etudiant_professionnel_pourcentage."%"; ?>
                    </span>
                </li>
            </ul>
        </div>
        <?php
            $rq_etudiant=$connexion->query("select e.id from etudiant e, typecompte t where e.idcompte = t.idcompte and t.status = 'Util'");
            $bac3=0;
            $bac4=0;
            $bac5=0;
            $bacPlus=0;
        ?>
        <div class="box-contact">
            <h1>Pourcentage de poursuite d'étude pour les niveaux bac +3, bac +4, bac +5, etc...</h1>
            <?php
                while($ligne=$rq_etudiant->fetch()){
                    $niveauEtudiant=$connexion->query("select count(*) as 'total' from etudiant e, etudier a where e.id = a.id and e.id= ".$ligne['id']);
                    $result=$niveauEtudiant->fetch();
                    switch($result['total']){
                      case 0:
                        break;
                      case 1:
                        $bac3++;
                        break;
                      case 2:
                        $bac4++;
                        break;
                      case 3:
                        $bac5++;
                        break;
                      default:
                        $bacPlus++;
                        break;
                    }
                }
                $totalEtudiant=($bac3+$bac4+$bac5+$bacPlus);
                if($bac3!=0){
                  $totalB3=($bac3*100)/$totalEtudiant;
                }
                else{
                  $totalB3=0;
                }
                if($bac4!=0){
                  $totalB4=($bac4*100)/$totalEtudiant;
                }
                else{
                  $totalB4=0;
                }
                if($bac5!=0){
                    $totalB5=($bac5*100)/$totalEtudiant;
                }
                else{
                    $totalB5=0;
                }
                if($bacPlus!=0){
                  $totalBPlus=($bacPlus*100)/$totalEtudiant;
                }
                else{
                  $totalBPlus=0;
                }
                echo "Nombre d'étudiant : ".$totalEtudiant."<br>Bac +3 : ".$totalB3."%<br>Bac +4 : ".$totalB4."%<br>Bac +5 : ".$totalB5."%<br>Bac supérieur à 5 : ".$totalBPlus."%";
            ?>
            <ul class="graph-vertical">
              <li>
                  <span>Bac +3</span>
                  <span style="height: <?php echo $totalB3/10;?>rem;">
                      <span class="cover">&nbsp; </span>
                      <?php echo $totalB3."%"; ?>
                  </span>
              </li>
              <li>
                  <span>Bac +4</span>
                  <span style="height: <?php echo $totalB4/10;?>rem;">
                      <span class="cover">&nbsp; </span>
                      <?php echo $totalB4."%"; ?>
                  </span>
              </li>
              <li>
                  <span>Bac +5</span>
                  <span style="height: <?php echo $totalB5/10;?>rem;">
                      <span class="cover">&nbsp; </span>
                      <?php echo $totalB5."%"; ?>
                  </span>
              </li>
              <li>
                  <span>Bac Supérieur</span>
                  <span style="height: <?php echo $totalBPlus/10;?>rem;">
                      <span class="cover">&nbsp; </span>
                      <?php echo $totalBPlus."%"; ?>
                  </span>
              </li>
            </ul>
        </div>
        <div class="box-contact">
            <?php
            $select_emploi=$connexion->query("select count(*) as 'nbEtudiant' from etudiant e, typecompte t, job j, emploi p WHERE t.idcompte = e.idcompte AND e.id = j.id AND j.id_emploi = p.id AND t.status = 'Util'");
            $total_etudiant=$select_emploi->fetch();

            $selectLibelleTotal=$connexion->query("select id from emploi");
            ?>
            <h1>Pourcentage par type de poste</h1>
            Nombre d'emploi : <?php echo $total_etudiant['nbEtudiant'];
            $array = [];
            echo "<br>";
            while($total_etudiant['nbEtudiant']!=0&&$nbEmploi=$selectLibelleTotal->fetch()){
                $requete=$connexion->query("select count(*) as 'total', p.libelle from etudiant e, typecompte t, job j, emploi p WHERE t.idcompte = e.idcompte AND e.id = j.id AND j.id_emploi = p.id AND t.status = 'Util' AND p.id = ".$nbEmploi['id']);
                $result=$requete->fetch();
                echo $result['libelle']." : ";
                $resu=floor(($result['total']*100)/$total_etudiant['nbEtudiant']);
                echo $resu."%";
                array_push($array,[$result['libelle'],$resu]);
                echo "<br>";
            }
            ?>
            <ul class="graph-vertical">
              <?php
              for($x=0;$x<count($array);$x++){
                ?>
                <li>
                    <span><?php echo $array[$x][0];?></span>
                    <span style="height: <?php echo $array[$x][1]/10;?>rem;">
                        <span class="cover">&nbsp; </span>
                        <?php echo $array[$x][1]."%"; ?>
                    </span>
                </li>
              <?php
              }
              ?>
            </ul>
        </div>
    </body>
</html>
