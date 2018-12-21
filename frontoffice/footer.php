<?php 
    if(empty($_SESSION['statut'])) 
    {
        header('Location: authentification.php');
    }
?>
<footer>
    <div class="text-footer">
        <br>
        Copyright © 2016
    </div>
</footer>