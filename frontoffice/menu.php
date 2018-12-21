<?php
    if(empty($_SESSION['statut']))
    {
        header('Location: authentification.php');
    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/styleNavigation.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="script.js"></script>
        <title>CSS MenuMaker</title>
    </head>
    <body>
        <div id='cssmenu'>
            <ul>
                <?php
                    if($_SESSION["page"] == "accueil")
                    {
                        echo "<li class='active'><a href='accueil.php'><span>Accueil</span></a></li>";
                    }
                    else
                    {
                        echo "<li><a href='accueil.php'><span>Accueil</span></a></li>";
                    }
                    if($_SESSION["statut"] == "Util")
                    {
                        if($_SESSION["page"] == "profil")
                        {
                            echo "<li class='active'><a href='profil2.php'><span>Profil</span></a></li>";
                        }
                        else
                        {
                            echo "<li><a href='profil2.php'><span>Profil</span></a></li>";
                        }

                        if($_SESSION["page"] == "contact")
                        {
                            echo "<li class='active'><a href='contact.php'><span>Contact</span></a></li>";
                        }
                        else
                        {
                            echo "<li><a href='contact.php'><span>Contact</span></a></li>";
                        }
                    }
                    if($_SESSION["page"] == "recherche")
                    {
                        echo "<li class='active'><a href='recherche.php'><span>Recherche</span></a></li>";
                    }
                    else
                    {
                        echo "<li><a href='recherche.php'><span>Recherche</span></a></li>";
                    }
                    if($_SESSION["statut"] == "Admin")
                    {
                        echo "<li><a href='#'<span>Gestion</span></a>";
                        echo "<ul>";
                        echo "<li><a href='../backoffice/choix_gestion_compte.php' ><span>Comptes</span></a></li>";
                        echo "<li><a href='../backoffice/choix_gestion_actualite.php'><span>Actualités</span></a></li>";
                        echo "<li><a href='../backoffice/choix_gestion_section.php'> <span>Sections BTS</span></a></li>";
                        echo "</ul></li>";
                        if ($_SESSION["page"]=="pourcentage")
                        {
                            echo "<li class='active'><a href='../backoffice/pourcentage.php'><span>Pourcentage</span></a></li>";
                        }
                        else{
                            echo "<li><a href='../backoffice/pourcentage.php'><span>Pourcentage</span></a></li>";
                        }
						 if($_SESSION["page"] == "contact_etudiant")
						{
							echo "<li class='active'><a href='contact_etudiant.php'><span>Contacter un étudiant</span></a></li>";
                }
                else
                {
                    echo "<li><a href='contact_etudiant.php'><span>Contacter un étudiant</span></a></li>";
                }
                    }
                    if($_SESSION["page"]=="forum"){
                        echo "<li class='active'><a href='forum.php'><span>Forum</span></a></li>";
                    }
                    else{
                        echo "<li><a href='forum.php'><span>Forum</span></a></li>";
                    }
                    if($_SESSION["page"]=="boitereception"){
                        echo "<li class='active'><a href='boite_reception.php'><span>Mail</span></a></li>";
                    }
                    else{
                        echo "<li><a href='boite_reception.php'><span>Mail</span></a></li>";
                    }
					if(isset($_SESSION['nom_etudiant'])){
						 echo "<li class='last'><a href='../frontoffice/authentification.php''><span>Deconnexion</span></a></li>";
						 $_SESSION['deco']='1';
					}
                ?>
				<li><a><?php echo $_SESSION['nom_etudiant'];?></a></li>
            </ul>
        </div>
    </body>
</html>
