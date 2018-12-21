<?php 
    session_start();
    if(empty($_SESSION['statut'])) 
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "accueil";
    
    require_once('connexionBD.php');
    
    $idnews = htmlentities($_GET["id"]);
    
    $actu="SELECT * FROM news WHERE IdNews='$idnews'";    
    $table = $connexion->query($actu);
    $ligne = $table->fetch();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleAccueil.css" />
        <link rel="stylesheet" href="../css/styleActualite.css" />
        <title></title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="accueil.php">Accueil</a> » <?php echo $ligne["titre"]; ?>
        </div>
        
        <div class="box-principal">
            <div class="titreActu">
                <h1>
                    <?php
                        echo $ligne["titre"];
                    ?>
                </h1>
            </div>
            <div class="categorie">
                <p><span id="categorie">Actualité : <?php echo $ligne["categorie"]; ?></span></p>
                
            </div>
            <div class="contenu">
                <?php
                    echo htmlspecialchars_decode(strip_tags($ligne["contenu"]));
                ?>
            </div>
            
            <div class="auteur_date">
                <p>Actualité posté par <span id="auteur"><?php echo $ligne["auteur"]; ?></span> le <span id="date"><?php echo $ligne["date"];?></span></p>
            </div>
        </div>       
    </body>
</html>
