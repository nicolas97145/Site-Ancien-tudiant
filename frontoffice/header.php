<?php 
    if(empty($_SESSION['statut'])) 
    {
        header('Location: authentification.php');
    }
?>
<header>
    <div class="top-header">
        
    </div>   
    
    <div class="bottom-header">    
        <!-- Entête de la zone considérée -->
        <a href="accueil.php">
            <img src="../images/logostpaul.png" alt="logo" title="logo" id="logo" /> 
        </a>
    </div>
</header>