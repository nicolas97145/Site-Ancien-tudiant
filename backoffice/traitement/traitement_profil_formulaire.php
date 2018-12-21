<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php   
    session_start();
    $part123NombreErreur = 0; // Variable qui compte le nombre d'erreur des parties 1,2,3
    $part4NombreErreur = 0; // Variable qui compte le nombre d'erreur de la partie 4
    $part5NombreErreur = 0; // Variable qui compte le nombre d'erreur de la partie 5
    $part6NombreErreur = 0; // Variable qui compte le nombre d'erreur de la partie 6
    
    /* Définit toutes les erreurs possibles */
   
    
    if (empty($_GET['nom']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['prenom']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['dtn']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['anEntre']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['anSortie']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['cursus']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['adresse']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['cp']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['ville']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['telfixe']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    if (empty($_GET['mobile']))
    {// Si la variable est vide
      $part123NombreErreur++;
    }
    #Verification du champ email
    if (empty($_GET['email']))
    { // Si la variable est vide
        $part123NombreErreur++; // On incrémente la variable qui compte les erreurs
    } 
    else
    { //Sinon la variable existe
        if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) // On vérifie 
        {
            $part123NombreErreur++; // On incrémente la variable qui compte les erreurs
        }
    }
    /*
     * récupération du nombre de ligne dans le tableau des poursuites d'études
     * pour voir dynamiquement s'il y a des erreurs peu importe la ligne
     */
    $nbLigne = (int)htmlentities($_GET['nbInfoFormation']);
    $i=0;
    while($i<$nbLigne+1)
    {
        if (empty($_GET['formation'.$i]))
        { // Si la variable est vide
            $part4NombreErreur++; // On incrémente la variable qui compte les erreurs
        }
        if (empty($_GET['annee'.$i]))
        { // Si la variable est vide
            $part4NombreErreur++; // On incrémente la variable qui compte les erreurs
        } 
        if (empty($_GET['discipline'.$i]))
        { // Si la variable est vide
            $part4NombreErreur++; // On incrémente la variable qui compte les erreurs
        }
        if (empty($_GET['etablissement'.$i]))
        { // Si la variable est vide
            $part4NombreErreur++; // On incrémente la variable qui compte les erreurs
        }
        $i++;
    }
    

    if (empty($_GET['posteoccupe']))
    { // Si la variable est vide
        $part5NombreErreur++; // On incrémente la variable qui compte les erreurs
    } 
    if (empty($_GET['typecontrat']))
    { // Si la variable est vide
        $part5NombreErreur++; // On incrémente la variable qui compte les erreurs
    } 
    
    if (empty($_GET['entreprise']))
    { // Si la variable est vide
        $part5NombreErreur++; // On incrémente la variable qui compte les erreurs
    }
    if (empty($_GET['adresseentreprise']))
    { // Si la variable est vide
        $part5NombreErreur++; // On incrémente la variable qui compte les erreurs
    } 
    if (empty($_GET['secteuractivite']))
    { // Si la variable est vide
        $part5NombreErreur++; // On incrémente la variable qui compte les erreurs
    } 
    $nbLigne2 = (int)htmlentities($_GET['nbInfoStage']);
    $k=0;
    while($k<$nbLigne2+1)
    {
        if (empty($_GET['nomStage'.$k]))
        { // Si la variable est vide
            $part6NombreErreur++; // On incrémente la variable qui compte les erreurs
        }
        if (empty($_GET['villeEntreprise'.$k]))
        { // Si la variable est vide
            $part6NombreErreur++; // On incrémente la variable qui compte les erreurs
        } 
        $k++;
    }
    
    
    
    //récupération des données de la base en fonction de l'idCompte pour gérer les cas UPDATE ou INSERT si des données sont déjà enregistrées ou non
    require_once('../../frontoffice/connexionBD.php');
    $idCompte=$_SESSION['idCompte'];

    $tableEtudiant="SELECT * FROM etudiant WHERE idCompte='".$idCompte."'";     
    $table1=$connexion->query($tableEtudiant);
    $ligne1 = $table1->fetch();
    //info passage dans l'établissement
    $anEntreBD=$ligne1['anneeEntre'];
    $anSortieBD=$ligne1['anneeSortie'];
    $cursusBD=$ligne1['cursus'];
    //info etudiant
    $adresseBD=$ligne1['adresse'];
    $cpBD=$ligne1['cp'];
    $villeBD=$ligne1['ville'];
    $fixeBD=$ligne1['fixe'];
    $mobileBD=$ligne1['mobile'];
    $mailBD=$ligne1['mail'];
    //info emploi
    $emploiBD=$ligne1['emploi'];
    $typeContratBD=$ligne1['typeContrat'];
    $entrepriseBD=$ligne1['entreprise'];
    $adresseEntBD=$ligne1['adresseEntreprise'];
    $secteurActiviteBD=$ligne1['secteurActivite'];

    $tablePoursuiteEtude="SELECT * FROM poursuiteetudes WHERE idCompte='".$ligne1['idCompte']."'";     
    $table2 = $connexion->query($tablePoursuiteEtude);
    echo $tablePoursuiteEtude;
    $tableStage="SELECT * FROM stage WHERE idCompte='".$ligne1['idCompte']."'";     
    $table3 = $connexion->query($tableStage);
echo $tableStage;
    
     //incrémentation +1 sur le dernière id de la table poursuiteetudes pour le prochain insert
    $selectIdPoursuiteEtude = $connexion->query('Select * from poursuiteetudes');
    $idPoursuiteEtude=0;
    while($lgnIdPoursuiteEtude = $selectIdPoursuiteEtude->fetch()) // créé un nouvel id pour l'utilisateur
    {
        $idPoursuiteEtude = $lgnIdPoursuiteEtude["id"];
    }
    $idPoursuiteEtude = $idPoursuiteEtude + 1;
    
    //incrémentation +1 sur le dernière id de la table stage pour le prochain insert
    $selectIdStage = $connexion->query('Select * from stage');
    $idStage=0;
    while($lgnIdStage = $selectIdStage->fetch()) // créé un nouvel id pour l'utilisateur
    {
        $idStage = $lgnIdStage["id"];
    }
    $idStage = $idStage + 1;
    
    //Gestion des différents cas en fonction des parties du formulaire remplit
    if($part123NombreErreur==0)
    {
        //récupération des données du formulaire
        $nom = htmlentities($_GET['nom']);
        $prenom = htmlentities($_GET['prenom']);
        $dtn = htmlentities($_GET['dtn']);
        $anEntre = htmlentities($_GET['anEntre']);
        $anSortie = htmlentities($_GET['anSortie']);
        $cursus = htmlentities($_GET['cursus']);
        $adresse = htmlentities($_GET['adresse']);
        $cp = htmlentities($_GET['cp']);
        $ville = htmlentities($_GET['ville']);
        $telfixe = htmlentities($_GET['telfixe']);
        $mobile = htmlentities($_GET['mobile']);
        $email = htmlentities($_GET['email']);
        /*
         * suite à la récupération des données de la base on vérifie s'il y en a déjà ou pas ou faire un INSERT ou UPDATE
         * 
         * la fonction str_replace est utilisé pour remplacer les espaces par des - dans la BDD(plus d'explication en commentaire dans profil.php)
         */
        if(empty($anEntreBD) and empty($anSortieBD) and empty($cursusBD) and empty($adresseBD) and empty($cpBD) and empty($villeBD) and empty($fixeBD) and empty($mobileBD) and empty($mailBD))
        {
            $sql="UPDATE etudiant SET nom='".str_replace(" ","-",$nom)."', prenom='".str_replace(" ","-",$prenom)."', dateNaissance='".$dtn."',"
                    . "adresse='".str_replace(" ","-",$adresse)."', cp='".$cp."', ville='".str_replace(" ","-",$ville)."' , fixe='".$telfixe."' , mobile='".$mobile."' , mail='".$email."',"
                    . "anneeEntre='".$anEntre."', anneeSortie='".$anSortie."',cursus='".str_replace(" ","-",$cursus)."'  WHERE idCompte ='".$idCompte."' ";
            $updatecas = $connexion->exec($sql);
        }
        if($part4NombreErreur==0)
        {
            $j=0;
            while( $ligne2 = $table2->fetch())
            {
                $sql="UPDATE poursuiteetudes SET formation='".str_replace(" ","-",htmlentities($_GET['formation'.$j]))."', anneeFormation='".(int)htmlentities($_GET['annee'.$j])."', discipline='".str_replace(" ","-",htmlentities($_GET['discipline'.$j]))."', etablissement='".str_replace(" ","-",htmlentities($_GET['etablissement'.$j]))."' WHERE id ='".$ligne2['id']."' ";
                $updatecas2 = $connexion->exec($sql);
                $j++;
            }
            while($j<$nbLigne+1)
            {
                $sql="INSERT INTO poursuiteetudes(id,formation,anneeFormation,discipline,etablissement,idCompte ) VALUES('$idPoursuiteEtude', '".str_replace(" ","-",htmlentities($_GET['formation'.$j]))."', '".(int)htmlentities($_GET['annee'.$j])."','".str_replace(" ","-",htmlentities($_GET['discipline'.$j]))."','".str_replace(" ","-",htmlentities($_GET['etablissement'.$j]))."','".$ligne1['idCompte']."')";
                $insertCas = $connexion->exec($sql);
                $idPoursuiteEtude++;
                $j++;
            }
        }
        if($part5NombreErreur==0)
        {
            $posteoccupe = htmlentities($_GET['posteoccupe']);
            $typecontrat = htmlentities($_GET['typecontrat']);
            $entreprise = htmlentities($_GET['entreprise']);
            $adresseentreprise= htmlentities($_GET['adresseentreprise']);
            $secteuractivite = htmlentities($_GET['secteuractivite']);
            
            if(empty($emploiBD) and empty($typeContratBD) and empty($entrepriseBD) and empty($adresseEntBD) and empty($secteurActiviteBD))
            {
                $sql="UPDATE etudiant SET emploi='".str_replace(" ","-",$posteoccupe)."', typeContrat='".$typecontrat."', entreprise='".str_replace(" ","-",$entreprise)."', adresseEntreprise='".str_replace(" ","-",$adresseentreprise)."',secteurActivite='".str_replace(" ","-",$secteuractivite)."' WHERE idCompte ='".$idCompte."' ";
                $insertCas = $connexion->exec($sql);
            }

        }
        if($part6NombreErreur==0)
        {
            $l=0;
            while( $ligne3 = $table3->fetch())
            {
                $sql="UPDATE stage SET EntNom='".str_replace(" ","-",htmlentities($_GET['nomStage'.$l]))."', EntVille='".str_replace(" ","-",htmlentities($_GET['villeEntreprise'.$l]))."' WHERE id ='".$ligne3['id']."' ";
                $updatecas = $connexion->exec($sql);
                $l++;
            }
            while($l<$nbLigne2+1)
            {
                $sql="INSERT INTO stage(id,EntNom,EntVille,idCompte ) VALUES('$idStage', '".str_replace(" ","-",htmlentities($_GET['nomStage'.$l]))."','".str_replace(" ","-",htmlentities($_GET['villeEntreprise'.$l]))."','".$ligne1['idCompte']."')";
                $insertCas = $connexion->exec($sql);
                $idStage++;
                $l++;
            }

        }
        //redirection 
        header('Location: ../../frontoffice/profil_formulaire_envoye.php');
    }
?>

