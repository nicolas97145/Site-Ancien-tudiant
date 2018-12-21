<?php
    session_start();
    if(empty($_SESSION['statut']))
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "forum";

    require_once('connexionBD.php');

    $select_themes=$connexion->query('SELECT * FROM theme');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleForum.css" />
        <script type="text/javascript" src="../js/tableau.js"></script>
        <title>Forum</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Forum
        </div>

        <div class="box-forum">
        <?php
	$i=0;
	echo "<div class='content-section'><div class='content-headersection'></div>";
        while($ligne=$select_themes->fetch()){
            echo "<div class='content-forumtheme'><a href='forumTheme.php?theme=".$ligne['id']."'>".$ligne['libelle']."</a></div>";
            if($i==7){
		echo "</div><div class='content-section'><div class='content-headersection'></div>";
	    }
	    $i++;
	}
	echo "</div>";
        ?>
        </div>
    </body>
</html>
