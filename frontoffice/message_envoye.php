<?php
    session_start();
    require_once('connexionBD.php');
    if(empty($_SESSION['statut'])||!isset($_POST['envoyeur'])||!isset($_POST['receveur'])||empty($_POST['envoyeur'])||empty($_POST['receveur'])||!isset($_POST['message'])||!isset($_POST['sujet'])||empty($_POST['message'])||empty($_POST['sujet']))
    {
        header('Location: authentification.php');
    }
    $insertMail=$connexion->query('INSERT INTO mail VALUES (null,"'.htmlentities($_POST['sujet']).'","'.htmlentities($_POST['message']).'",'.$_POST['envoyeur'].','.$_POST['receveur'].')');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>Contact</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <aside><!-- Les à-cotés de la page --></aside>
        <article>
            <!-- Contenu textuel de la page -->
            <meta http-equiv="refresh" content="4;accueil.php" />
            <p id="message_envoye">Votre message a bien été envoyé. Vous allez etre redirigé vers la page d'accueil dans quelques secondes.</p>
        </article>
        <footer><!-- Pied-de-page de la page -> site --></footer>
    </body>
</html>
