<?php 
   session_start();
    if(empty($_SESSION['statut']) or $_SESSION['statut']!="Util") 
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "profil2";
    require_once('connexionBD.php');
    $idEtudiant = $_SESSION["idEtudiant"];
    
    $select_bts = ('Select * from bts');
    $query_select_bts = $connexion->query($select_bts);

    $recup_infos = ('Select * from etudiant where id = '.$idEtudiant.';');
    $query_recup_infos = $connexion->query($recup_infos);
    $lgn_recup_infos = $query_recup_infos->fetch();

    $recup_job = ('Select * from job where id = '.$idEtudiant.';');
    $query_recup_job = $connexion->query($recup_job);
    $lgn_recup_job = $query_recup_job->fetch();
    
if(!empty($lgn_recup_job["id"])){
    $recup_entreprise = ('Select * from entreprise where id_secteurActivite = "3"');
    $query_recup_entreprise = $connexion->query($recup_entreprise);
    $lgn_recup_entreprise = $query_recup_entreprise->fetch();
}

    $recup_etudier = ('Select * from etudier where id = '.$idEtudiant.';');
    $query_recup_etudier = $connexion->query($recup_etudier);
    
    $recup_stage = ('Select * from stage where id = '.$idEtudiant.';');
    $query_recup_stage = $connexion->query($recup_stage);
    
    $date_debut = ('select * from passage where id = '.$idEtudiant.';');
    $query_date_debut = $connexion->query($date_debut);
    $date_value = $query_date_debut->fetch();
    
    $date_naissance = ('select dateNaissance from etudiant where id = '.$idEtudiant.';');
    $query_date_naissance = $connexion->query($date_naissance);
    $date_value_naissance = $query_date_naissance->fetch();
    
    $recup_job = ('select * from job,emploi where job.id = '.$idEtudiant.';');
    $query_job = $connexion->query($recup_job);
    $query_recup_job = $query_job->fetch();
    
    
    
    $recup_secteur_cherche = ('select * from secteuractivite');
    $query_secteur_cherche = $connexion->query($recup_secteur_cherche);
    
    $recup_nom_entreprise = ('select * from entreprise, job where job.id='.$idEtudiant.' and job.id_entreprise = entreprise.id;');
    $query_nom_entreprise = $connexion->query($recup_nom_entreprise);
    $query_recup_nom_entreprise = $query_nom_entreprise->fetch();
    
    $recup_secteur = ('select * from secteuractivite,entreprise,job where job.id_entreprise = entreprise.id and entreprise.id_secteurActivite=secteuractivite.id and job.id = '.$idEtudiant.';');
    $query_secteur = $connexion->query($recup_secteur);
    $query_recup_secteur = $query_secteur->fetch();
    
    $query_recup_job = $connexion -> query ('select * from job,entreprise,emploi,secteuractivite where job.id='.$idEtudiant.' and entreprise.id = job.id_entreprise and emploi.id=job.id_emploi and entreprise.id_secteurActivite = secteuractivite.id');
    
    $query_recup_stage = $connexion -> query ('select * from stage,entreprise,secteuractivite where stage.id='.$idEtudiant.' and entreprise.id = stage.id_entreprise and entreprise.id_secteurActivite = secteuractivite.id');
    
    
    
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styleProfil.css">
        <script type="text/javascript" src="../js/tableau.js"></script>
    </head>
    <body id="ajout">
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?> 
        <!--- Zone fil ariane --->
        <div class="filArianeProfil">
            <a href="../frontoffice/accueil.php">Accueil</a> » Profil
        </div>
        <div id="divPrincipal" class="box-principalProfil">
            <form method="post" action="traitement_profil.php" id="modifForm">
                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number1">1</span>Vous êtes :</h1>
                    <input type="text" name="nom" placeholder="Nom : <?php echo $lgn_recup_infos["nom"] ?>" value="<?php echo $lgn_recup_infos["nom"] ?>" class="titre" required/>
                    <input type="text" name="prenom" placeholder="Prenom : <?php echo $lgn_recup_infos["prenom"] ?>" value="<?php echo $lgn_recup_infos["prenom"] ?>" class="titre" required/>
                    <input type="date" name="date_de_naissance" value="<?php echo $date_value_naissance['dateNaissance']; ?>"class="titre" required>               
                </div>

                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number2">2</span>Passage dans l'établissement</h1>
                    <p>Vous êtes entré dans l'établissement en :</p>
                    
                    <input type="date" name="dateEntree" value="<?php echo $date_value['anneeEntre']; ?>"class="titre" required>
                    
                    <p>Et vous y êtes sortie en : </p>
                    <input type="date" name="dateSortie" value="<?php echo $date_value['anneeSortie']; ?>"class="titre" required>
                    
                    <p>Pour un BTS :</p>
                    <select class="select" name="libelle_bts">
                    <?php                    
                        while($ligneBts = $query_select_bts->fetch())
                        {
                            echo '<option value="'.$ligneBts["id"].'">'.$ligneBts["libelleBTS"].'</option>';
                        }
                    ?>          
                     </select>    
                </div>

                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number3">3</span>Comment vous contacter?</h1>
                    <input type="text" name="adresse" placeholder="Adresse" value="<?php echo $lgn_recup_infos["adresse"]; ?>" class="titre" required/>
                    <input type="text" name="cp" placeholder="Code postal" value="<?php echo $lgn_recup_infos["cp"]; ?>"  class="titre" required/>
                    <input type="text" name="ville" placeholder="Ville" value="<?php echo $lgn_recup_infos["ville"]; ?>" class="titre" required/>
                    <input type="text" name="telfixe" placeholder="N° de téléphone fixe" value="<?php echo $lgn_recup_infos["fixe"]; ?>" class="titre" required/>
                    <input type="text" name="portable" placeholder="N° de portable" value="<?php echo $lgn_recup_infos["mobile"]; ?>" class="titre" required/>
                    <input type="text" name="email" placeholder="Email" value="<?php echo $lgn_recup_infos["mail"]; ?>" class="titre" required/>
                </div>

                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number4">4</span>Poursuite d'études</h1> 
                    <table id="tableauProfil">
                        <tr>
                            <td>Formation</td>
                            <td>Année(XXXX)</td>
                            <td>Discipline</td>
                            <td>Établissement</td>
                            <td>Adresse</td>
                            <td>CP</td>
                            <td>Ville</td>
                        </tr>
                        <?php 
                            $i=1;
                            while($lgn_recup_etudier = $query_recup_etudier->fetch())
                            {
                                $recup_etablissement = ("Select * from etudier,etablissement where etudier.id = etablissement.id and etudier.id = ".$lgn_recup_etudier["id"].";");
                                $query_recup_etablissement = $connexion->query($recup_etablissement);
                                $lgn_recup_etablissement = $query_recup_etablissement->fetch();
                                
                                $recup_adr = ("select * from etablissement, etudier where etablissement.id = etudier.id_etablissement and etudier.id = '$idEtudiant'");
                                $query_select_adr = $connexion->query($recup_adr);
                                $exec_query_select_adr = $query_select_adr->fetch();
                                                                
                                echo    '<tr>
                                            <td><input type="text" name="formation'.$i.'" value="'.$lgn_recup_etudier["formation"].'" class="titre" /></td>
                                            
                                            <td><input type="number" id="verifAnnee'.$i.'" onchange="verifAnnee('.$i.');" name="annee'.$i.'" value="'.$lgn_recup_etudier["annee"].'" class="titre" /></td>
                                            <td><input type="text" name="discipline'.$i.'" value="'.$lgn_recup_etudier["discipline"].'" class="titre" /></td>
                                            <td><input type="text" name="etablissement'.$i.'" value="'.$exec_query_select_adr["nomEta"].'" class="titre" /></td>
                                            <td><input type="text" name="adresse'.$i.'" value="'.$exec_query_select_adr["adresse"].'" class="titre" /></td>
                                            <td><input type="text" name="cp'.$i.'" value="'.$exec_query_select_adr["cp"].'" class="titre" /></td>
                                            <td><input type="text" name="ville'.$i.'" value="'.$exec_query_select_adr["ville"].'" class="titre" /></td>
                                        </tr>';
                                $i++;
                            }
                        ?>
                    </table>
                    
                    <a href="javascript:addRowEtude('tableauProfil');">Ajouter une ligne</a>
                </div>  
                
                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number5">5</span>Votre parcours professionnel</h1> 
                    <table id="tableauTravail">
                        <tr>
                            <td>Emploi</td>
                            <td>Nom - Entreprise</td>
                            <td>Adresse - Entreprise</td>
                            <td>Secteur d'activité</td>
                            <td>Date de début</td>
                            <td>Date de fin</td>
                        </tr>
                        <?php 
                            $i=1;
                            while($lgn_recup_job = $query_recup_job->fetch())
                            {
                                $recup_emploi = ('select * from emploi');
                                $query_emploi = $connexion->query($recup_emploi);
                                
                                $recup_secteur = ('select * from secteuractivite');
                                $query_secteur = $connexion->query($recup_secteur);
                                
                                echo    '<tr>
                                        <td><select class="select" name="emploi'.$i.'">';
                                while($ligneemploi = $query_emploi->fetch()){
                                    if($lgn_recup_job["id_emploi"]==$ligneemploi['id']){
                                        echo '<option value="'.$ligneemploi["id"].'" selected>'.$ligneemploi["libelle"].'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="'.$ligneemploi["id"].'">'.$ligneemploi["libelle"].'</option>';
                                    }
                                   
                                } 
                                echo '</select></td>
                                        <td><input  type="text" name="nomEnt'.$i.'" value="'.$lgn_recup_job["nomEnt"].'" class="titre" /></td>
                                        <td><input type="text" name="adrEnt'.$i.'" value="'.$lgn_recup_job["villeEnt"].'" class="titre" /></td>
                                            
                                        <td><select class="select" name="secteur'.$i.'">';
                                while($lignesecteur = $query_secteur->fetch()){
                                    if($lgn_recup_job["id_secteurActivite"]==$lignesecteur['id']){
                                        echo '<option value="'.$lignesecteur["id"].'" selected>'.$lignesecteur["libelle"].'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="'.$lignesecteur["id"].'">'.$lignesecteur["libelle"].'</option>';
                                    }
                                   
                                } 
                                echo '</select></td>
                                    <td><input type="date" name="dateDebut'.$i.'" value="'.$lgn_recup_job["dateJ"].'" class="titre" /></td>
                                    <td><input type="date" name="dateFin'.$i.'" value="'.$lgn_recup_job["dateFin"].'" class="titre" /></td>
                                            
                                        </tr>';
                                $i++;
                            }
                        ?>
                    </table>
                    
                    <a href="javascript:addRowTravail('tableauTravail');">Ajouter une ligne</a>
                </div>  

                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number6">6</span>Vos stages</h1>                   
                    <table id="tableauStage">
                        <tr>
                            <td>Objectif du stage</td>
                            <td>Nom de l'entreprise</td>
                            <td>Adresse</td>
                            <td>Secteur d'activité</td>
                            <td>Date de début</td>
                            <td>Date de fin</td>
                        </tr>
                        <?php 
                            $i=1;
                            while($lgn_recup_stage = $query_recup_stage->fetch())
                            {
                                
                                $recup_secteur = ('select * from secteuractivite');
                                $query_secteur = $connexion->query($recup_secteur);
                                
                                $recup_entreprise = ("Select * from stage,entreprise where stage.id = entreprise.id and stage.id = ".$lgn_recup_stage["id"].";");
                                $query_recup_entreprise = $connexion->query($recup_entreprise);
                                $lgn_recup_entreprise = $query_recup_entreprise->fetch();
                                echo    '<tr>
                                            <td><input type="text" name="objectifStage'.$i.'" value = "'.$lgn_recup_stage["objectifDuStage"].'" class="titre" required/></td>
                                            <td><input type="text" name="nomEntrepriseStage'.$i.'" value="'.$lgn_recup_stage["nomEnt"].'" class="titre" required/></td>
                                            <td><input type="text" name="adresseStage'.$i.'" value="'.$lgn_recup_stage["villeEnt"].'" class="titre" required/></td>
                                            <td><select class="select" name="secteurStage'.$i.'">';
                                while($lignesecteur = $query_secteur->fetch()){
                                    if($lgn_recup_job["id_secteurActivite"]==$lignesecteur['id']){
                                        echo '<option value="'.$lignesecteur["id"].'" selected>'.$lignesecteur["libelle"].'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="'.$lignesecteur["id"].'">'.$lignesecteur["libelle"].'</option>';
                                    }
                                   
                                } 
                                echo '</select></td>    
                                            <td><input type="date" name="datedebutStage'.$i.'" value="'.$lgn_recup_stage["dateJ"].'" class="titre" required/></td>
                                            <td><input type="date" name="datefinStage'.$i.'" value="'.$lgn_recup_stage["dateFin"].'" class="titre" required/></td>
                                        </tr>';
                                $i++;
                            }
                        ?>
                    </table>
                    <a href="javascript:addRowStage('tableauStage');">Ajouter une ligne</a>
                </div>
                <br>
                <button>Valider</button>
            </form>
        </div>
    </body>
</html>