<?php
session_start();
if (empty($_SESSION['statut']) or $_SESSION['statut'] != "Util") {
    header('Location: authentification.php');
}
$_SESSION["page"] = "profil_remplir";
$idCompte = $_SESSION["idEtudiant"];
require_once('connexionBD.php');


$select_bts = ('Select * from bts');
$query_select_bts = $connexion->query($select_bts);

$recup_infos = ('Select * from etudiant where id = '.$idCompte.';');
$query_recup_infos = $connexion->query($recup_infos);
$lgn_recup_infos = $query_recup_infos->fetch();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styleProfil.css">
        <script type="text/javascript" src="../js/tableau.js"></script>
    </head>
    <body id="ajout">
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?> 
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Profil
        </div>
        <div id="divPrincipal" class="box-principal">
            Avant de continuer, veuillez remplir votre profil
            <form method="post" action="traitement_profil_remplir.php" id="modifForm">
                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number1">1</span>Vous êtes :</h1>
                    <input type="text" name="nom" placeholder="Nom : <?php echo $lgn_recup_infos["nom"] ?>" value="<?php echo $lgn_recup_infos["nom"] ?>" class="titre" required/>
                    <input type="text" name="prenom" placeholder="Prenom : <?php echo $lgn_recup_infos["prenom"] ?>" value="<?php echo $lgn_recup_infos["prenom"] ?>" class="titre" required/>
                    <input type="date" name="date_de_naissance" placeholder="Date de naissance : <?php echo $lgn_recup_infos["dateNaissance"] ?>" value="<?php echo $lgn_recup_infos["dateNaissance"] ?>" class="titre" required/>               
                </div>

                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number2">2</span>Comment vous contacter?</h1>
                    <input type="text" name="adresse" placeholder="Adresse <?php echo $lgn_recup_infos["adresse"] ?>" value="<?php echo $lgn_recup_infos["adresse"] ?>"class="titre" required/>
                    <input type="text" name="cp" placeholder="Code postal <?php echo $lgn_recup_infos["cp"] ?>" value="<?php echo $lgn_recup_infos["cp"] ?>" class="titre" required/>
                    <input type="text" name="ville" placeholder="Ville <?php echo $lgn_recup_infos["ville"] ?>" value="<?php echo $lgn_recup_infos["ville"] ?>" class="titre" required/>
                    <input type="text" name="telfixe" placeholder="N° de téléphone fixe <?php echo $lgn_recup_infos["fixe"] ?>" value="<?php echo $lgn_recup_infos["fixe"] ?>" class="titre" required/>
                    <input type="text" name="portable" placeholder="N° de portable <?php echo $lgn_recup_infos["mobile"] ?>" value="<?php echo $lgn_recup_infos["mobile"] ?>" class="titre" required/>
                    <input type="text" name="email" placeholder="Email <?php echo $lgn_recup_infos["mail"] ?>" value="<?php echo $lgn_recup_infos["mail"] ?>" class="titre" required/>
                </div>
                <br>
                <button>Valider</button>
            </form>
        </div>
    </body>
</html>
