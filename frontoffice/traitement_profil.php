<?php


session_start();
require_once('connexionBD.php');
if (empty($_SESSION['statut'])or $_SESSION['statut'] != "Util") {
    header('Location: ../frontoffice/authentification.php');
}

$idEtudiant = $_SESSION["idEtudiant"];
$select_etudiant = $connexion->query('Select * from etudiant');

/*Création d'un nouvel id pour l'étudiant*/
/*$cpt = 1;
$ok = true;
while (($lgn = $select_etudiant->fetch()) && ($ok == true)) { // Test les id existants
while (($lgn = $select_etudiant->fetch()) && ($ok == true)) { // Test les id existants
    if ($lgn["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
        $ok = false;
    } else {
        $cpt = $cpt + 1;
    }
}
$id = $cpt;*/

$nom = html_entity_decode($_POST["nom"]);
$prenom = html_entity_decode($_POST["prenom"]);
$date = html_entity_decode($_POST["date_de_naissance"]);


$adresse = html_entity_decode($_POST["adresse"]);
$cp = html_entity_decode($_POST["cp"]);
$ville = html_entity_decode($_POST["ville"]);
$telfixe = html_entity_decode($_POST["telfixe"]);
$portable = html_entity_decode($_POST["portable"]);
$email = html_entity_decode($_POST["email"]);

$anneeentree = html_entity_decode($_POST["dateEntree"]);
$aneesortie = html_entity_decode($_POST["dateSortie"]);
$idbts = html_entity_decode($_POST["libelle_bts"]);

//$select_id_entreprise = ('select id from entreprise where nomEnt= "'.$nomEnt.'";');
//$query_select_id_entreprise = $connexion -> query($select_id_entreprise);
//$select_value = $query_select_id_entreprise->fetch();


$date_debut = ('select * from passage where id = '.$idEtudiant.';');
    $query_date_debut = $connexion->query($date_debut);
    $date_value = $query_date_debut->fetch();
    
$job_debut =('select * from job where id='.$idEtudiant.';');
$query_job_debut = $connexion->query($job_debut);
$job_value = $query_job_debut->fetch();




/*Récupération du tableau de formation*/
$test = true;
$i=1;
$select_etudier = ("select * from etudier");
$query_select_etudier  = $connexion -> query($select_etudier);
$exec_select_etudier = $query_select_etudier -> fetch();

if(!empty($exec_select_etudier["id"])){
	$delete_etudier = ("delete from etudier where id= '$idEtudiant'");
	$exec_delete_etudier = $connexion -> exec ($delete_etudier);
	echo $delete_etudier;
}
        
while($test)
{
    if(empty($_POST["formation".$i]) or empty($_POST["annee".$i]) or empty($_POST["discipline".$i]) or empty($_POST["etablissement".$i]))
    {
        $test = false;
    }
    else
    {
        $formation = $_POST["formation".$i];
        $annee = $_POST["annee".$i];
        $discipline = $_POST["discipline".$i];
        $etablissement = $_POST["etablissement".$i];
        $adresse = $_POST["adresse".$i];
        $cp = $_POST["cp".$i];
        $ville = $_POST["ville".$i];
        
        
        
        $Insert_etablissement = ("Insert into etablissement(nomEta,adresse,cp,ville) values('$etablissement','$adresse','$cp','$ville')");
        echo $Insert_etablissement; 
        $exec_etablissement = $connexion->exec($Insert_etablissement);
        $insert_date = ("insert into annee(annee) values ('$annee')");
        echo $insert_date;
        $exec_insert_date = $connexion -> exec ($insert_date);
        
        $select_id_etablissement = $connexion -> query("select id from etablissement where nomEta='$etablissement'");
        $exec_select_id_etablissement = $select_id_etablissement ->fetch();
        
        $insert_poursuite =("insert into etudier (formation,discipline,id,id_etablissement,annee) values('$formation','$discipline','$idEtudiant',".$exec_select_id_etablissement['id'].",'$annee')");
        echo $insert_poursuite;
        $exec_insert_poursuite = $connexion -> exec($insert_poursuite);
        
       
    }
    $i++;
}



/*Récupération du tableau de carrière*/
$test = true;
$i=1;

while($test)
{
    if(empty($_POST["emploi".$i]) or empty($_POST["nomEnt".$i]) or empty($_POST["adrEnt".$i]) or empty($_POST["secteur".$i])or empty($_POST["dateDebut".$i])or empty($_POST["dateFin".$i]))
    {
        $test = false;
    }
    else
    {
        $emploi = $_POST["emploi".$i];
        $nomEnt = $_POST["nomEnt".$i];
        $adrEnt = $_POST["adrEnt".$i];
        $secteur = $_POST["secteur".$i];
        $dateDebut = $_POST["dateDebut".$i];
        $dateFin = $_POST["dateFin".$i];        
        
        echo $secteur;
        echo $nomEnt;
        echo $adrEnt;
        echo $dateDebut;
        echo $idEtudiant;
        
        if(!empty($select_job['id'])){
               
                $delete_job = "delete from job where id = '$idEtudiant'";
                echo $delete_job;
                $exec_delete_job = $connexion -> exec($delete_job);
        }
        //$delete_date = ("delete from date where dateDebut = '$dateDebut'");
        //echo $delete_date;
        //$exec_delete_date = $connexion-> exec($delete_date);
        
    
        
       
        
        $delete_entreprise = ("delete from entreprise where nomEnt='$nomEnt' and adr");
        //echo $delete_entreprise;
        $exec_delete_entreprise = $connexion -> exec($delete_entreprise);
        
        $insert_secteur = ("insert into entreprise(nomEnt,villeEnt,id_secteurActivite) values ('$nomEnt','$adrEnt',".$secteur.");");
        //echo $insert_secteur;
        $exec_insert_secteur = $connexion -> exec($insert_secteur);
        
        /*Select id de l'entreprise*/
        
        $select_id_entreprise = $connexion -> query("select id from entreprise where nomEnt ='$nomEnt'");
        $exec_select_id_entreprise = $select_id_entreprise -> fetch();
      
        $insert_date = $connexion -> exec ("insert into date(dateJ) values ('$dateDebut')");
             
        $insert_job =("insert into job (dateFin,id,id_entreprise,id_emploi,dateJ) values ('$dateFin','$idEtudiant',".$exec_select_id_entreprise["id"].",'$emploi','$dateDebut')");
        echo $insert_job;
        $exec_insert_job = $connexion -> exec($insert_job);
		echo "JOB : ".$i." .";
    }
    $i++;
}



/****/
//echo $date;
$update_etudiant = ("update etudiant SET nom='$nom', prenom='$prenom', dateNaissance='$date', adresse='$adresse', cp='$cp', ville= '$ville', fixe='$telfixe', mobile='$portable', mail='$email' where id = '$idEtudiant';");
$exec_update = $connexion->exec($update_etudiant);
//echo $update_etudiant;
/*Création d'un id d'entreprise*/
$select_entreprise = $connexion->query('Select * from entreprise');
$cpt = 1;
$ok = true;
while (($lgn = $select_entreprise->fetch()) && ($ok == true)) { // Test les id existants
    if ($lgn["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
        $ok = false;
    } else {
        $cpt = $cpt + 1;
    }
}
$idEntreprise = $cpt;

//$Insert_entreprise = ("Insert into entreprise values('$idEntreprise', '$entreprise', '$adresseentreprise');");
//$exec_entreprise = $connexion->exec($Insert_entreprise);

/*Création d'un id de job*/
$select_job = $connexion->query('Select * from job');
$cpt = 1;
$ok = true;
while (($lgn = $select_job->fetch()) && ($ok == true)) { // Test les id existants
    if ($lgn["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
        $ok = false;
    } else {
        $cpt = $cpt + 1;
    }
}
$idJob = $cpt;

//$Insert_job = ("Insert into job values('$datedebut', '$datefin', '$emploi', '$secteur', $idJob, '$idEtudiant');");
//$exec_job = $connexion->exec($Insert_job);


/*Récupération du tableau de stages*/
$test = true;
$i=1;

 $select_stage = ("select * from stage");
        $query_select_stage  = $connexion -> query($select_stage);
        $exec_select_stage = $query_select_stage -> fetch();
        
        if(!empty($exec_select_stage["id"])){
            $delete_stage = ("delete from stage where id= '$idEtudiant'");
            $exec_delete_stage = $connexion -> exec ($delete_stage);
            echo $delete_stage;
        }
        
while($test)
{
    if(empty($_POST["nomEntrepriseStage".$i]) or empty($_POST["adresseStage".$i]) or empty($_POST["datedebutStage".$i]) or empty($_POST["datefinStage".$i])or empty($_POST["secteurStage".$i]) or empty($_POST["objectifStage".$i]))
    {
        $test = false;
    }
    else
    {
        $objectif = $_POST["objectifStage".$i];
        $nomEnt = $_POST["nomEntrepriseStage".$i];
        $adrEnt = $_POST["adresseStage".$i];
        $secteur = $_POST["secteurStage".$i];
        $dateDebut = $_POST["datedebutStage".$i];
        $datefin = $_POST["datefinStage".$i];
        
        $insert_secteur = ("insert into entreprise(nomEnt,villeEnt,id_secteurActivite) values ('$nomEnt','$adrEnt',".$secteur.");");
        //echo $insert_secteur;
        $exec_insert_secteur = $connexion -> exec($insert_secteur);
        
        /*Select id de l'entreprise*/
        
        $select_id_entreprise = $connexion -> query("select id from entreprise where nomEnt ='$nomEnt'");
        $exec_select_id_entreprise = $select_id_entreprise -> fetch();
      
        $insert_date = $connexion -> exec ("insert into date(dateJ) values ('$dateDebut')");
             
        $insert_stage =("insert into stage (objectifDuStage,dateFin,id,id_entreprise,dateJ) values ('$objectif','$dateFin','$idEtudiant',".$exec_select_id_entreprise["id"].",'$dateDebut')");
        echo $insert_stage;
        $exec_insert_stage = $connexion -> exec($insert_stage);
        
        
        
    }
    $i++;
}
/****/
if(!empty($date_value["id"])){
$insert_passage = $connexion->exec("update passage set anneeEntre='$anneeentree', anneeSortie='$aneesortie', id='$idEtudiant', id_BTS='$idbts'");
}
else{
    $insert_passage = $connexion->exec("insert into passage values ('$anneeentree','$aneesortie','$idEtudiant','$idbts');");
}

header('Location: profil_formulaire_envoye.php');

?>