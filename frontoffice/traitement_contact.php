<?php   
    //====================================
    // TRAITEMENT DE L'ENVOIE DE L'EMAIL
    //==================================== 

    //-----------------------------------
    // Verification des champs
    //-----------------------------------
            
    $nombreErreur = 0; // Variable qui compte le nombre d'erreur
    
    /* Définit toutes les erreurs possibles */
   
    #Verification du champ nom
    if (empty($_POST['nom']))
    {// Si la variable est vide
      $nombreErreur++;
      $erreur1 = '<p>Veuillez renseigner un nom.</p>';
    }

    #Verification du champ email
    if (empty($_POST['email']))
    { // Si la variable est vide
        $nombreErreur++; // On incrémente la variable qui compte les erreurs
        $erreur2 = '<p>Veuillez renseigner un email.</p>';
    } 
    else
    { //Sinon la variable existe
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // On vérifie 
        {
            $nombreErreur++; // On incrémente la variable qui compte les erreurs
            $erreur3 = '<p>Veuillez renseigner un email valide.</p>';
        }
    }
    
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
        $nom = htmlentities($_POST['nom']); // htmlentities() convertit des caractères "spéciaux" en équivalent HTML
        $email = htmlentities($_POST['email']);
        $message = htmlentities($_POST['message']);
        $sujet = htmlentities($_POST['sujet']);


        $destinataire = 'yohan.gounou@gmail.com'; // Adresse email de l'administrateur
        $sujet_bis = $sujet; // Titre de l'email
        $contenu = '<html><head><title>Titre du message</title></head><body>';
        $contenu .= '<p>Bonjour, vous avez reçu un nouveau message :</p>';
        $contenu .= '<p><strong>Nom</strong>: '.$nom.'</p>';
        $contenu .= '<p><strong>Email</strong>: '.$email.'</p>';
        $contenu .= '<p><strong>Message</strong>: '.$message.'</p>';
        $contenu .= '</body></html>'; // Contenu du message de l'email (en XHTML)
        
        // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        
        // Envoyer l'email
        mail($destinataire, $sujet_bis, $contenu, $headers); // Fonction principale qui envoi l'email
        header('Location: ../frontoffice/message_envoye.php'); // Afficher un message pour indiquer que le message a été envoyé
        
    } 
    else
    { // S'il y a un moins une erreur
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