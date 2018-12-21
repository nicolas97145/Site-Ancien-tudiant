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



$date_debut = ('select * from passage where id = '.$idEtudiant.';');
    $query_date_debut = $connexion->query($date_debut);
    $date_value = $query_date_debut->fetch();
    
$job_debut =('select * from job where id='.$idEtudiant.';');
$query_job_debut = $connexion->query($job_debut);
$job_value = $query_job_debut->fetch();




/*Récupération du tableau de formation*/
$test = true;
$i=1;
$Delete_etudier = ("Delete from etudier where id_etudiant='$idEtudiant'");
$del_etudier = $connexion->exec($Delete_etudier);
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
        
        /*Création d'un nouvel id pour la table étudier*/
        $select_etablissement = $connexion->query('Select * from etablissement');
        $cpt = 1;
        $ok = true;
        while (($lgn = $select_etablissement->fetch()) && ($ok == true)) { // Test les id existants
            if ($lgn["id"] != $cpt) {// Si l'id testé est différent de cpt alors l'id sera celui testé
                $ok = false;
            } else {
                $cpt = $cpt + 1;
            }
        }
        $idEtablissement = $cpt;
        
        //$Delete_etablissement = ("Delete from etablissement where id='$idEtablissement'");
        
        $Insert_etablissement = ("Insert into etablissement values(".$idEtablissement.", '".$etablissement."', null, null, null);");
        $exec_etablissement = $connexion->exec($Insert_etablissement);
        
        //$Insert_etudier = ("update etudier, etablissement set formation = '$formation', annee = '$annee', discipline = '$discipline', nomEta= '$etablissement' where id_etudiant = '$idEtudiant';");
        
        
        $Insert_etudier = ("Insert into etudier values('$formation', '$annee','$discipline', '$idEtablissement', '$idEtudiant');");
        echo $Insert_etudier;
        $exec_etudier = $connexion->exec($Insert_etudier);
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
while($test)
{
    if(empty($_POST["nomEntreprise".$i]) or empty($_POST["adresse".$i]) or empty($_POST["datedebut".$i]) or empty($_POST["datefin".$i]))
    {
        $test = false;
    }
    else
    {
        $nomEntreprise = $_POST["nomEntreprise".$i];
        $adresse = $_POST["adresse".$i];
        $datedebut = $_POST["datedebut".$i];
        $datefin = $_POST["datefin".$i];
        
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
        
        $Insert_entreprise = ("Insert into entreprise values($idEntreprise, '$nomEntreprise', '$adresse');");
        echo $Insert_entreprise."<br>";
        $exec_entreprise = $connexion->exec($Insert_entreprise);
        
        $Insert_stage = ('Insert stage values('.$datefin.', '.$datedebut.', '.$idEntreprise.', "'.$idEtudiant.'");');
        echo $Insert_stage."<br>";
        $exec_stage = $connexion->exec($Insert_stage);
    }
    $i++;
}
/****/

header('Location: profil_formulaire_envoye.php');

?>