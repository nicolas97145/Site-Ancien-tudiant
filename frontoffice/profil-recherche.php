<?php
require_once('../frontoffice/connexionBD.php');
if(isset($_GET['get'])&&!empty($_GET['get'])){
    $rep="[";
    if($_GET['get']=='emploi'){
        $select_emploi=$connexion->query('SELECT * from emploi');
        while($ligne=$select_emploi->fetch()){
            if($rep != "["){$rep.=",";}
            $rep.='{"id":"'.$ligne['id'].'","libelle":"'.$ligne['libelle'].'"}';
        }
    }
    if($_GET['get']=='secteuractivite'){
        $select_emploi=$connexion->query('SELECT * from secteuractivite');
        while($ligne=$select_emploi->fetch()){
            if($rep != "["){$rep.=",";}
            $rep.='{"id":"'.$ligne['id'].'","libelle":"'.$ligne['libelle'].'"}';
        }
    }
    if($_GET['get']=='etablissement'){
        $select_emploi=$connexion->query('SELECT * from etablissement');
        while($ligne=$select_emploi->fetch()){
            if($rep != "["){$rep.=",";}
            $rep.='{"id":"'.$ligne['id'].'","nomEta":"'.$ligne['nomEta'].'"}';
        }
    }
    $rep.="]";
    echo $rep;
}
?>
