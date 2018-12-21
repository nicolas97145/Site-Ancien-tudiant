<?php 
    require_once('../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut']) or $_SESSION['statut']!="Admin") 
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "contact_etudiant";
    $select_comptes = ('Select idCompte,nom,prenom from etudiant');
    $query_select = $connexion->query($select_comptes);
?>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <!--<script type="text/javascript" src="../js/verification_contact.js"></script>-->
      <title>Contacter un étudiant</title>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../css/styleContact.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>   
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Contacter un étudiant
        </div>
        
               
            <div id="divPrincipal" class="box-contact">
                <h1>Formulaire de contact</h1>
                <form action="../backoffice/traitement_contact_etudiant.php" method="POST" name="formulaire">             
                    <select class="select" name="id">
                        <?php
                            while($lgn = $query_select->fetch())
                            {
                                echo '<option value="'.$lgn["idCompte"].'">'.$lgn["nom"].' '.$lgn["prenom"].'</option>';
                            }
                        ?>
                    </select>
                    
                    <p id="erreursujet"></p>
                    <input class="input" name="sujet" type="text" placeholder="Sujet" id="sujet" required/>                  

                    <p id="erreurmessage"></p>
                    <textarea class="input" name="message" placeholder="Commentaire" id="message" required></textarea>                                   
                    
                    <button>Envoyer</button>               
                </form>
            </div>
    </body>
</html>
