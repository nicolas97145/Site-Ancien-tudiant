<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php   
    require_once('../frontoffice/connexionBD.php');
    //====================================
    // TRAITEMENT DE L'ENVOIE DE L'EMAIL
    //==================================== 

    //-----------------------------------
    // Verification des champs
    //-----------------------------------
            
    $nombreErreur = 0; // Variable qui compte le nombre d'erreur
    
    /* Définit toutes les erreurs possibles */

    $id = htmlentities($_POST["id"]);
    
    $select_mail = $connexion->query("Select mail from infoetudiant where id = ".$id.";");
    $destinataire = $select_mail->fetch();
    $mail = $destinataire["mail"];
    #Verification du champ sujet
    if (empty($_POST['sujet']))
    {// Si la variable est vide
      $nombreErreur++;
      $erreur4 = '<p>Veuillez renseigner un sujet.</p>';
    }
 
    #Verification du champ message
    if (empty($_POST['message']))
    {// Si la variable est vide
      $nombreErreur++;
      $erreur5 = '<p>Veuillez renseigner un message.</p>';
    }
  
   
    // A coder : captcha anti-spam.
    
    //-----------------------------------
    // Mise en forme du message 
    //-----------------------------------
    
    // S'il n'y a pas d'erreur
    if ($nombreErreur==0)
    { 
      // Ici il faudra ajouter tout le code pour envoyer l'email.
        $message = htmlentities($_POST['message']);
        $sujet = htmlentities($_POST['sujet']);


        $sujet_bis = $sujet; // Titre de l'email
        $contenu = '<html><head><title>Titre du message</title></head><body>';
        $contenu .= '<p><strong>Message</strong>: '.$message.'</p>';
        $contenu .= '</body></html>'; // Contenu du message de l'email (en XHTML)
        
        // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        
        // Envoyer l'email
        mail($mail, $sujet_bis, $contenu, $headers); // Fonction principale qui envoi l'email
        header('Location: ../frontoffice/message_envoye.php'); // Afficher un message pour indiquer que le message a été envoyé
    } 
    
    // S'il y a au moins une erreur
    else
    { 
      echo '<div style="border:2px solid #109177; padding:5px;">';
      echo '<p style="color:#109177;">Désolé, il y a eu '.$nombreErreur.' erreur(s). Voici le détail des erreurs:</p>';
      if (isset($erreur1)) echo '<p>'.$erreur1.'</p>';
      if (isset($erreur2)) echo '<p>'.$erreur2.'</p>';
      if (isset($erreur3)) echo '<p>'.$erreur3.'</p>';
      if (isset($erreur4)) echo '<p>'.$erreur4.'</p>';
      if (isset($erreur5)) echo '<p>'.$erreur5.'</p>';
      // A coder : si un captcha anti-spam est erroné.
      echo '</div>';
    }
?>