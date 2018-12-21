<?php
    session_start();
    if(empty($_SESSION['statut'])||$_SESSION['statut']!="Admin"||!isset($_GET['id'])||empty($_GET['id']))
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "contact";
?>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>Contact</title>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../css/styleContact.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Contact
        </div>

        <div class="box-contact">
            <h1>Formulaire de contact</h1>
            <form action="message_envoye.php" method="POST" name="formulaire">
                <input type="text" value="<?php echo $_GET['id']; ?>" name="receveur" hidden/>

                <input type="text" value="<?php echo $_SESSION['idEtudiant']; ?>" name="envoyeur" hidden/>

                <p id="erreursujet"></p>
                <input class="input" name="sujet" type="text" placeholder="sujet" required/>

                <p id="erreurmessage"></p>
                <textarea class="input" name="message" placeholder="message" required></textarea>

                <button>Envoyer</button>
            </form>
        </div>
    </body>
</html>
