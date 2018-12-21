<?php
require_once('../frontoffice/connexionBD.php');
if(isset($_GET['x'])){
  switch($_GET['x']){
    case 'recherche-select-entreprise':
      $select_stage = $connexion->query("select a.nom, a.prenom, a.id, t.status from entreprise e, stage s, etudiant a, typecompte t WHERE a.idcompte = t.idcompte AND a.id = s.id AND s.id_entreprise = e.id AND e.id = ".$_GET['value']);
      $rep="[";
      while($ligne_stage=$select_stage->fetch()){
        if($ligne_stage['status']!="Admin"){
          if($rep != "["){$rep.=",";}
            $rep.='{"id":"'.$ligne_stage['id'].'",';
            $rep.='"job" : "false",';
            $rep.='"nom":"'.$ligne_stage["nom"].'",';
            $rep.='"prenom":"'.$ligne_stage["prenom"].'"}';
        }
      }
      $select_job = $connexion->query("select a.nom, a.prenom, a.id, t.status from entreprise e, job j, etudiant a, typecompte t WHERE a.idcompte = t.idcompte AND a.id = j.id AND j.id_entreprise = e.id AND e.id = ".$_GET['value']);
      while($ligne_job=$select_job->fetch()){
        if($ligne_job['status']!="Admin"){
          if($rep != "["){$rep.=",";}
            $rep.='{"id":"'.$ligne_job['id'].'",';
            $rep.='"job" : "true",';
            $rep.='"nom":"'.$ligne_job["nom"].'",';
            $rep.='"prenom":"'.$ligne_job["prenom"].'"}';
        }
      }
      $rep.="]";
      echo $rep;
      $select_stage->closeCursor();
      $select_job->closeCursor();
      break;
    case 'recherche-select-bts':
      /*Récupération des entreprises*/
      $select_etudiant = ('Select * from bts,passage,etudiant where passage.id_BTS = bts.id and passage.id = etudiant.id and id_BTS = '.$_GET['value']);
      $query_select_etudiant = $connexion->query($select_etudiant);
      $rep="[";
      while($lgn_etudiant = $query_select_etudiant->fetch())
      {
        if($rep != "["){$rep.=",";}
          $rep.='{"id":"'.$lgn_etudiant['id'].'",';
          $rep.='"nom":"'.$lgn_etudiant["nom"].'",';
          $rep.='"prenom":"'.$lgn_etudiant["prenom"].'"}';
      }
      $rep.="]";
      echo $rep;
      $query_select_etudiant->closeCursor();
      break;
    case 'recherche-select-nom':
      $select_personne = $connexion->query("select * from etudiant e, typecompte t where (e.nom like '%".$_GET['value']."%' OR e.prenom like '%".$_GET['value']."%') AND e.idcompte = t.idcompte");
      $rep="[";
      while($ligne = $select_personne->fetch())
      {
        if($ligne["status"]!="Admin"){
          if($rep != "["){$rep.=",";}
          $rep.='{"id":"'.$ligne['id'].'",';
          $rep.='"nom":"'.$ligne["nom"].'",';
          $rep.='"prenom":"'.$ligne["prenom"].'"}';
        }
      }
      $rep.="]";
      echo $rep;
      $select_personne->closeCursor();
      break;
    case 'recherche-select-etablissement':
      $select_etudiant = $connexion->query("select a.id, a.nom, a.prenom, t.status from etudier e, etudiant a, typecompte t where e.id_etablissement = ".$_GET['value']." AND e.id = a.id AND a.idCompte = t.idCompte");
      $rep="[";
      while($ligne = $select_etudiant->fetch())
      {
        if($ligne['status']!="Admin"){
          if($rep != "["){$rep.=",";}
          $rep.='{"id":"'.$ligne['id'].'",';
          $rep.='"nom":"'.$ligne["nom"].'",';
          $rep.='"prenom":"'.$ligne["prenom"].'"}';
        }
      }
      $rep.="]";
      echo $rep;
      $select_etudiant->closeCursor();
      break;
    case 'recherche-select-promo':
      $select_etudiant = $connexion->query("select * from passage where year(anneeSortie) = ".$_GET['value']);
      $rep="[";
      while($ligne = $select_etudiant->fetch())
      {
         $result=$connexion->query('select * from etudiant where id = '.$ligne['id']);
         $resu=$result->fetch();
        if($rep != "["){$rep.=",";}
          $rep.='{"id":"'.$resu['id'].'",';
          $rep.='"nom":"'.$resu["nom"].'",';
          $rep.='"prenom":"'.$resu["prenom"].'"}';
      }
      $rep.="]";
      echo $rep;
      $select_etudiant->closeCursor();
      break;
  }
}
?>
