<?php


session_start();
require_once('../../frontoffice/connexionBD.php');


    if(empty($_POST["idbts"]) or empty($_POST["libellebts"]))
    {
        $test = false;
        echo "ok";
    }
    else
    {   
        
        $idbts = $_POST["idbts"];
        $libellebts = $_POST["libellebts"];
        $cache = $_POST ["cache"];
        echo "ok" + $cache;
        
        $insert_bts = ("insert into bts values ('$idbts','$libellebts')");
        echo $insert_bts;
        $exec_insert_bts = $connexion -> exec($insert_bts);
        
        $update_passage= ("update passage set id_bts='$idbts' where id_bts='$cache'");
        echo $update_passage;
        $exec_update_passage = $connexion -> exec($update_passage);
        
        
        
        
        
    }
//header('Location: ../../frontoffice/profil_formulaire_envoye.php');

?>