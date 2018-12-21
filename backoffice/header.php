<?php 
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin") 
    {
        header('Location:  ../frontoffice/authentification.php');
    }
?>
<header>
    <div class="top-header">
        
    </div>   
    
    <div class="bottom-header">    
        <!-- Entête de la zone considérée sghddfhgfhdgfhfh -->
        <a href="../frontoffice/accueil.php">
            <img src="../images/logostpaul.png" alt="logo" title="logo" id="logo" /> 
        </a>
    </div>
</header>