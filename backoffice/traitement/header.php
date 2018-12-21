<?php 
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location:  ../frontoffice/authentification.php');
    }
?>
<header>
    <div class="top-header">
        
    </div>   
    <!-- Entête de la zone considérée -->
    <a href="../../frontoffice/accueil.php">
        <img src="../../images/logostpaul.png" alt="logo" title="logo" id="logo" /> 
    </a>
</header>