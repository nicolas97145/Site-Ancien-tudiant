<?php
require_once('../frontoffice/connexionBD.php');
if(isset($_GET['cat'])&&!empty($_GET['cat'])&&isset($_GET['recherche'])&&isset($_GET['theme'])&&!empty($_GET['theme'])){
    $requete='select distinct s.id as "idsujet", e.nom as "nom", e.prenom as "prenom", s.libelle as "libelle", e.id as "id" from etudiant e, sujet s where e.id = s.id_etudiant AND s.id_Theme = '.$_GET['theme'];
    if($_GET['cat']=='Auteur'){
        $requete.=" AND (e.nom like '%".$_GET['recherche']."%' OR e.prenom like '%".$_GET['recherche']."%')";
    }
    if($_GET['cat']=='Sujet'){
        $requete.=" AND s.libelle like '%".$_GET['recherche']."%'";
    }
    $rq=$connexion->query($requete);
    $rep="[";
    while($ligne=$rq->fetch()){
      if($rep != "["){$rep.=",";}
      $chercheNombre=$connexion->query('select count(*) as "nb" from post where id_sujet = '.$ligne['idsujet']);
      $get=$chercheNombre->fetch();
      $rep.='{"id":"'.$ligne['id'].'",';
      $rep.='"nom":"'.$ligne["nom"].'",';
      $rep.='"libelle":"'.$ligne["libelle"].'",';
      $rep.='"idsujet":"'.$ligne["idsujet"].'",';
      $rep.='"nb":"'.$get["nb"].'",';
      $rep.='"prenom":"'.$ligne["prenom"].'"}';
    }
    $rep.="]";
    echo $rep;
}
