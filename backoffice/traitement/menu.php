<?php 
    if(empty($_SESSION['statut'])) 
    {
        header('Location: ../../frontoffice/authentification.php');
    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/styleNavigation.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="script.js"></script>
        <title>CSS MenuMaker</title>
    </head>
    <body>
        <div id='cssmenu'>
            <ul>                              
                <?php
                //Test le lien actif du menu
                if($_SESSION["page"] == "accueil")
                {
                    echo '<li class="active"><a href="../../frontoffice/accueil.php "><span>Accueil</span></a></li>';
                }
                else
                {
                    echo '<li><a href="../../frontoffice/accueil.php "><span>Accueil</span></a></li>';
                }
                if($_SESSION["page"] == "recherche")
                {
                    echo "<li class='active'><a href='../../frontoffice/recherche.php'><span>Recherche</span></a></li>";
                }
                else
                {
                    echo "<li><a href='../../frontoffice/recherche.php'><span>Recherche</span></a></li>";
                }
                
                if($_SESSION["page"] == "gestion")
                {
                    echo "<li class='active'><a href='#'<span>Gestion</span></a>";
                    echo "<ul>";
                    echo "<li><a href='../choix_gestion_compte.php' <span>Comptes</span></a></li>";
                    echo "<li><a href='../choix_gestion_actualite.php' <span>Actualités</span></a></li>";
                    echo "<li><a href='../choix_gestion_section.php' <span>Sections BTS</span></a></li>";
                    echo "</ul></li>";
                }
                else
                {
                    echo "<li><a href='#'<span>Gestion</span></a>";
                    echo "<ul>";
                    echo "<li><a href='../choix_gestion_compte.php' <span>Comptes</span></a></li>";
                    echo "<li><a href='../choix_gestion_actualite.php' <span>Actualités</span></a></li>";
                    echo "<li><a href='../choix_gestion_section.php' <span>Sections BTS</span></a></li>";
                    echo "</ul></li>";
                }

                if($_SESSION["page"] == "contact_etudiant")
                {
                    echo "<li class='active'><a href='../contact_etudiant.php'><span>Contacter un étudiant</span></a></li>";
                }
                else
                {
                    echo "<li><a href='../contact_etudiant.php'><span>Contacter un étudiant</span></a></li>";
                }
                ?>
                <li class='last'><a href='../../frontoffice/authentification.php'><span>Deconnexion</span></a></li>
            </ul>
        </div>
    </body>
</html>
