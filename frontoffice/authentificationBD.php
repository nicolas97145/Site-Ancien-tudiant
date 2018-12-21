<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php

    //-----------------------------------
    // Verification des champs
    //-----------------------------------
    session_start();
    $nombreErreur = 0; // Variable qui compte le nombre d'erreur

    /* Définit toutes les erreurs possibles */

    #Verification du champ identifiant
    if (empty($_REQUEST['Mail']))
    {// Si la variable est vide
      $nombreErreur++;
      $erreur1 = '<p>Veuillez renseigner votre identifiant.</p>';
    }

    #Verification du champ mot de passe
    if (empty($_REQUEST['Password']))
    {// Si la variable est vide
      $nombreErreur++;
      $erreur2 = '<p>Veuillez renseigner votre mot de passe.</p>';
    }

    // S'il n'y a pas d'erreur
    if ($nombreErreur==0)
    {
        $mail = htmlentities($_REQUEST["Mail"]);
        $mdp = htmlentities($_REQUEST["Password"]);
        require_once('connexionBD.php');
        $mdp=md5($mdp);
        $tableuser="SELECT * FROM etudiant WHERE mail='".addslashes($mail)."' AND password='".addslashes($mdp)."'";
        $table = $connexion->query($tableuser);
        $ligne = $table->fetch();
        $_SESSION['idCompte'] =$ligne['idCompte'];
        //récupération des données pour voir si c'est la première connexion de l'utilisateur
        $tableEtud="SELECT * FROM typecompte WHERE idCompte='".$_SESSION['idCompte']."'";
        $table2 = $connexion->query($tableEtud);
        $ligne2 = $table2->fetch();
        $statut=$ligne2['status'];
        $_SESSION['statut'] = $statut;
        $dateNaissance = $ligne['dateNaissance'];
        $adresse = $ligne['adresse'];
        $cp = $ligne['cp'];
        $ville=$ligne['ville'];
        $fixe=$ligne['fixe'];
        $mobile=$ligne['mobile'];
        $_SESSION["idEtudiant"] = $ligne['id'];
		$_SESSION['nom_etudiant']=$ligne['nom'];

        if($mail==$ligne['mail'] and $mdp==$ligne['password'])
        {
            if($statut!="Admin" and empty($dateNaissance) and empty($adresse) and empty($cp) and empty($ville) and empty($fixe) and empty($mobile))
            {
               header('Location: profil_remplir.php');
            }
            else
            {
               header('Location: accueil.php');
            }
        }
        else
        {
            header('Location: authentification.php');
        }
        $table->closeCursor();
    }

    // S'il y a au moins une erreur
    else
    {
      echo '<div style="border:2px solid #109177; padding:5px;">';
      echo '<p style="color:#109177;">Désolé, il y a eu '.$nombreErreur.' erreur(s). Voici le détail des erreurs:</p>';
      if (isset($erreur1)) echo '<p>'.$erreur1.'</p>';
      if (isset($erreur2)) echo '<p>'.$erreur2.'</p>';
      // A coder : si un captcha anti-spam est erroné.
      echo '</div>';
    }
?>
