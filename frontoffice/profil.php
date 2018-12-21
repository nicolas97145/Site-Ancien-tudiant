<?php 
   session_start();
    if(empty($_SESSION['statut']) or $_SESSION['statut']!="Util") 
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "profil";
    require_once('connexionBD.php');
    
    //Récupération des différentes informations de l'étudiant pour ensuite lui afficher son profil 
    $idCompte=$_SESSION['idCompte'];
    $tableEtudiant="SELECT * FROM etudiant WHERE idCompte='".$idCompte."'";     
    $table1=$connexion->query($tableEtudiant);
    $ligne1 = $table1->fetch();
    $nom=$ligne1['nom'];
    $prenom=$ligne1['prenom'];
    $dateNaissance=$ligne1['dateNaissance'];
    //info passage dans l'établissement
    $anEntre=$ligne1['anneeEntre'];
    $anSortie=$ligne1['anneeSortie'];
    $cursus=$ligne1['cursus'];
    //info etudiant
    $adresse=$ligne1['adresse'];
    $cp=$ligne1['cp'];
    $ville=$ligne1['ville'];
    $fixe=$ligne1['fixe'];
    $mobile=$ligne1['mobile'];
    $mail=$ligne1['mail'];
    //info emploi
    $emploi=$ligne1['emploi'];
    $typeContrat=$ligne1['typeContrat'];
    $entreprise=$ligne1['entreprise'];
    $adresseEnt=$ligne1['adresseEntreprise'];
    $secteurActivite=$ligne1['secteurActivite'];

    $tablePoursuiteEtude="SELECT * FROM poursuiteetudes WHERE idCompte='".$ligne1['idCompte']."'";     
    $table2 = $connexion->query($tablePoursuiteEtude);
    //concaténation des informations de la poursuite d'étude pour passer le tout
    //en paramètre de la fonction javascript qui va ajouter dynamiquement
    //le formulaire de modification du profil dans la page avec les informations
    //éxistante dans les champs adapté
    $formation="";
    while($ligne2 = $table2->fetch())
    {
        $formation=$formation."/".$ligne2['formation']."/".$ligne2['anneeFormation']."/".$ligne2['discipline']."/".$ligne2['etablissement'];
    }
    
    $tableStage="SELECT * FROM stage WHERE idCompte='".$ligne1['idCompte']."'"; 
    $table3 = $connexion->query($tableStage);
    $stage="";
    while($ligne3 = $table3->fetch())
    {
        $stage=$stage."/".$ligne3['EntNom']."/".$ligne3['EntVille'];
    }
    
    //concaténation des différentes informations sauf la poursuite d'étude pour passer le tout
    //en paramètre de la fonction javascript qui va ajouter dynamiquement
    //le formulaire de modification du profil dans la page avec les informations
    //éxistante dans les champs adapté
    $totalInfos=$nom."/".$prenom."/".$dateNaissance."/".$anEntre."/".$anSortie."/".$cursus."/".$adresse."/".$cp."/".$ville."/".$fixe."/"
            .$mobile."/".$mail."/".$emploi."/".$typeContrat."/".$entreprise."/".$adresseEnt."/"
            .$secteurActivite;
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styleProfil.css">
        <script type="text/javascript" src="../js/profil_formulaire.js"></script>
    </head>
    <body id="ajout">
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?> 
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Profil
        </div>
        <div id="divPrincipal" class="box-principal">
            <form id="modifForm">

                <?php 
                    /*
                     * les différentes conditions des IF suivant dans le code avec l'utilisation de la fonction empty
                     * vérifie si oui ou non les informations de l'étudiant existe déjà, si existe on lui affiche
                     * sinon un message l'informe qu'elles sont les informations qu'il n'a pas rentré.
                     * 
                     * Pour l'affichage de différentes variables la fonction str_replace est utilisé pour remplacer les
                     * - par des espaces. Les informations dans la BDD n'ont pas d'espace mais des - car lors du passages 
                     * de toutes les informations concaténé dans la fonction javascript pour afficher le formulaire de
                     * modification avec les informations déjà existantes, laisser une espace provoquerait une erreur javascript.
                     * 
                     * il y a au minimum le nom/prenom/date de naissance qui ont été rentré par l'administrateur à la création
                     * du compte de l'utilisateur qui sont affiché.
                     */
                    if(empty($anEntre) and empty($anSortie) and empty($cursus) and empty($adresse) and empty($cp) and empty($ville) and empty($fixe) and empty($mobile) and empty($mail))
                    {
                        echo    "<div id='divSecondaire' class='box-Secondaire'>
                                <h1><span class="."number"." id="."number1".">1</span>Vous êtes :</h1>
                                <p>".str_replace("-"," ",$nom)."</p>
                                <p>".str_replace("-"," ",$prenom)."</p>
                                <p>Né le : ".$dateNaissance."</p>
                            </div>";
                        echo "<p id="."information_non_renseigne".">Vous n'avez pas encore renseigné toutes vos informations !</p>";
                    }
                    else
                    {
                        echo "<div id='divSecondaire' class='box-Secondaire'>
                                <h1><span class="."number"." id="."number1".">1</span>Vous êtes :</h1>
                                <p>".str_replace("-"," ",$nom)."</p>
                                <p>".str_replace("-"," ",$prenom)."</p>
                                <p>Né le : ".$dateNaissance."</p>
                            </div>
                            <div id='divSecondaire' class='box-Secondaire'>
                                <h1><span class="."number"." id="."number2".">2</span>Passage dans l'établissement</h1>
                                <p>Vous êtes entré dans l'établissement en : ".$anEntre."</p>
                                <p>Et vous y êtes sortie en : ".$anSortie."</p>
                                <p>Pour un : ".str_replace("-", " ", $cursus)."</p>
                            </div>
                            <div id='divSecondaire' class='box-Secondaire'>
                                <h1><span class="."number"." id="."number3".">3</span>Comment vous contacter?</h1>
                                <p>Votre adresse : ".str_replace("-"," ",$adresse)."</p>
                                <p>Votre code postal: ".$cp."</p>
                                <p>Votre ville : ".str_replace("-"," ",$ville)."</p>
                                <p>Votre numéro de téléphone fixe : ".$fixe."</p>
                                <p>Votre numéro de portable : ".$mobile."</p>
                                <p>Votre eMail : ".$mail."</p>
                            </div>";
                        $chaineFormation=explode("/",$formation);
                        if( empty($chaineFormation[1]) and empty($chaineFormation[2]) and empty($chaineFormation[3]))
                        {
                            echo "<p id="."information_non_renseigne".">Partie 4 qui est votre poursuite d'études
                                    non renseigné</p>";
                        }
                        else
                        {
                            echo "<div id='divSecondaire' class='box-Secondaire'>
                                <h1><span class="."number"." id="."number4".">4</span>Poursuite d'études</h1>
                                    <table id="."tableauProfil".">
                                        <tr>
                                            <th>Formation</th>
                                            <th>Année</th>
                                            <th>Discipline</th>
                                            <th>Établissement</th>
                                        </tr>";
                            $i=0;
                            $j=1;
                            $nbLigne=(count($chaineFormation)-1)/4;
                            while($i<$nbLigne)
                            {
                                echo "<tr>
                                        <td>".str_replace("-"," ",$chaineFormation[$j])."</td>";
                                $j=$j+1;
                                echo    "<td>".str_replace("-"," ",$chaineFormation[$j])."</td>";
                                $j=$j+1;
                                echo    "<td>".str_replace("-"," ",$chaineFormation[$j])."</td>";
                                $j=$j+1;
                                echo    "<td>".str_replace("-"," ",$chaineFormation[$j])."</td>
                                    </tr>";
                                $j=$j+1;
                                $i=$i+1;
                            }
                            echo "  </table>
                                </div>";
                        }
                        if(empty($emploi) and empty($typeContrat) and empty($entreprise) and empty($adresseEnt) and empty($secteurActivite))
                        {
                            echo "<p id="."information_non_renseigne".">Partie 5 qui est votre emploi
                            non renseigné</p>";
                        }
                        else
                        {
                            echo "<div id='divSecondaire' class='box-Secondaire'>
                                <h1><span class="."number"." id="."number5".">5</span>Votre parcours professionnel</h1>
                                <p>Vous emploi : ".str_replace("-"," ",$emploi)."</p>
                                <p>Le type de contract : ".$typeContrat."</p>
                                <p>Dans l'entreprise : ".str_replace("-"," ",$entreprise)."</p>
                                <p>Adresse de l'entreprise : ".str_replace("-"," ",$adresseEnt)."</p>
                                <p>Dans le secteur d'activité : ".str_replace("-"," ",$secteurActivite)."</p>
                                </div>";
                        }
                         $chaineStage=explode("/",$stage);
                        if(empty($chaineStage[1]) and empty($chaineStage[2]))
                        {
                            echo "<p id="."information_non_renseigne".">Partie 6 qui concerne vos stages
                                    non renseigné</p>";
                        }
                        else
                        {
                            echo "<div id='divSecondaire' class='box-Secondaire'>
                                <h1><span class="."number"." id="."number6".">6</span>Vos stages</h1>
                                    <table id="."tableauStage".">
                                        <tr>
                                            <th>Nom de l'entreprise</th>
                                            <th>Ville où elle est situé</th>
                                        </tr>";
                            $k=0;
                            $l=1;
                            $nbLigne2=(count($chaineStage)-1)/2;
                            while($k<$nbLigne2)
                            {
                                echo "<tr>
                                        <td>".str_replace("-"," ",$chaineStage[$l])."</td>";
                                $l=$l+1;
                                echo    "<td>".str_replace("-"," ",$chaineStage[$l])."</td>
                                    </tr>";
                                $l=$l+1;
                                $k=$k+1;
                            }
                            echo "  </table>
                                </div>";
                        }   
                    }
                     echo "<div id='divSecondaire' class='box-Secondaire'>".
                             "<p id="."information_non_renseigne".">Pour modifier, cliquez sur le boutton si dessous :</p>"
                         ."</div>"    
                        . "<input class='bouton' type="."button"." value="."Modifier"." onClick="."afficheFormulaire("."'".$totalInfos."'".","."'".$formation."'".","."'".$stage."'".");"." />";
                ?>
            </form>
        </div>
    </body>
</html>
