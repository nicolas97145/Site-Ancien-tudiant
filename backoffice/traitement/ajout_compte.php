<?php
    require_once('../../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin")
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $statut = htmlentities($_POST["statut"]);
    // $ok vaut 1 si tous les test sont ok
    // sinon il sera passé à 0 et l'ajout ne sera pas effectué
    $ok = 1;
    //test des variables
    if((isset($_POST["mail"])) && (strlen(trim($_POST["mail"])) > 0))
    {
        $mail = htmlentities($_POST["mail"]);
    }
    else
    {
        $mail = "Il faut renseigner un mail.";
        $ok = 0;
    }
    if((isset($_POST["mdp"])) && (strlen(trim($_POST["mdp"])) > 0))
    {
        $mdp = htmlentities($_POST["mdp"]);
    }
    else
    {
        $mdp = "Il faut renseigner un mot de passe.";
        $ok = 0;
    }
    if((isset($_POST["nom"])) && (strlen(trim($_POST["nom"])) > 0))
    {
        $nom = htmlentities($_POST["nom"]);
        $nom=str_replace(" ","-",$nom);
    }
    else
    {
        $nom = "Pas mentionner.";
    }
    if((isset($_POST["prenom"])) && (strlen(trim($_POST["prenom"])) > 0))
    {
        $prenom = htmlentities($_POST["prenom"]);
        $prenom=str_replace(" ","-",$prenom);
    }
    else
    {
        $prenom = "Pas mentionner.";
    }
    if((isset($_POST["dateN"])) && (strlen(trim($_POST["dateN"])) > 0))
    {
        $dateN = htmlentities($_POST["dateN"]);
    }
    else
    {
        $dateN = "Pas mentionner.";
    }


?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link rel="stylesheet" href="../../css/styleGestionCompte.css">
        <title>Gestion anciens étudiants</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » <a href="../choix_gestion_compte.php">Gestion des comptes</a> » Ajout du compte
        </div>
        <div class="box-principal">
            <h1>
                <?php
                if($ok == 0)
                {
                    echo "Le compte n'a pas été créé";
                }
                else
                {
                    echo "Compte créé";
                }
                ?>
            </h1>
            <label><span class="recap">Statut du compte : </span><?php echo $statut; ?></label>
            <label><span class="recap">Mail : </span><?php echo $mail; ?></label>
            <label><span class="recap">Nom : </span><?php echo $nom; ?></label>
            <label><span class="recap">Prénom : </span><?php echo $prenom; ?></label>
            <label><span class="recap">Date de naissance : </span><?php echo $dateN; ?></label>
            <label><span class="recap">Mot de passe : </span><?php echo $mdp; ?></label>
            <a href="../choix_gestion_compte.php"><input class='bouton' type="button" name="nom" value="Ajouter un compte"></a>
	</div>
    </body>
</html>

<?php
    $mdp=md5($mdp);
    if($ok==1){
      if(empty($_POST['nom'])){
        $nom='null';
      }
      else{
        $nom="'".htmlentities($_POST['nom'])."'";
      }
      if(empty($_POST['prenom'])){
        $prenom='null';
      }
      else{
        $prenom="'".htmlentities($_POST['prenom'])."'";
      }
      if(empty($_POST['dateN'])){
        $dateN='null';
      }
      else{
        $dateN="'".htmlentities($_POST['dateN'])."'";
      }
      if($statut=="Administrateur"){
        $connexion->exec("INSERT INTO etudiant VALUES (0,$nom,$prenom,$dateN,null,null,null,null,null,'".htmlentities($_POST['mail'])."','".md5(htmlentities($_POST['mdp']))."',1)");
      }
      else{
        $connexion->exec("INSERT INTO etudiant VALUES (0,$nom,$prenom,$dateN,null,null,null,null,null,'".htmlentities($_POST['mail'])."','".md5(htmlentities($_POST['mdp']))."',2)");
      }
    }
?>
