<?php
    session_start();
    if(empty($_SESSION['statut'])||!isset($_GET['sujet'])||empty($_GET['sujet']))
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "forum";
    require_once('connexionBD.php');
    $requete='SELECT t.id as "idTheme", t.libelle as "libelleTheme", s.id_etudiant as "idetudiant", s.sujet as "sujet",';
    $requete.='s.libelle as "libelle", s.theDate as "date", s.id as "idsujet", e.nom as "nom", e.prenom as "prenom" FROM sujet s, theme t, etudiant e WHERE e.id = s.id_etudiant AND s.id_Theme = t.id AND s.id = '.$_GET["sujet"];
    $select_sujet=$connexion->query($requete);
    $get_sujet=$select_sujet->fetch();

    if(isset($_POST['message'])&&!empty($_POST['message'])){
        $insert=$connexion->query('INSERT INTO post VALUES(null,"'.date("Y-m-d H:i:s").'","'.$_POST['message'].'",'.$_SESSION['idCompte'].','.$_GET['sujet'].')');
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleForum.css" />
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
        <title>Forum</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » <a href="../frontoffice/forum.php">Forum</a> » <a href="forumTheme.php?theme=<?php echo $get_sujet['idTheme']; ?>"><?php echo $get_sujet['libelleTheme']; ?></a> » <?php echo $get_sujet['libelle']; ?>
        </div>

        <a href="#answer">Répondre</a>

        <!-- Voir les posts -->
        <div class="box-forum">
            <!-- div emboitant le message -->
            <div class="bloc-message-forum">
                <!-- header de cette même boite -->
                <div class="bloc-header">
                <?php
                //Gère le premier message
                    echo $get_sujet['nom']." ".$get_sujet['prenom'];
                    echo "<br>".$get_sujet['date'];
                ?>
                </div>
                <!-- contenu message -->
                <div class="bloc-contenu">
                <?php
                    echo $get_sujet['sujet'];
                ?>
                </div>
            </div>
            <?php
            //Gère les messages du post
            $rq=$connexion->query('SELECT p.theDate, p.message, e.nom, e.prenom, e.id FROM post p,etudiant e where p.id_etudiant = e.id AND id_sujet = '.$get_sujet['idsujet'].' ORDER BY p.theDate');
            while($ligne=$rq->fetch()){
            ?>
              <div class="bloc-message-forum">
                  <div class="bloc-header">
                      <a href="affiche_profil?id=<?php echo $ligne['id']; ?>"><?php echo $ligne['nom']." ".$ligne['prenom'] ?></a>
                      <?php echo $ligne['theDate']; ?>
                  </div>
                  <div class="bloc-contenu">
                  <?php echo $ligne['message']; ?>
                  </div>
              </div>
            <?php
            }
            ?>
        </div>

        <!--  Créer un nouveau sujet -->
        <div id="answer" class="box-forum">
            <form action="forumSujet.php?sujet=<?php echo $_GET['sujet']; ?>" method="POST">
                <label>Répondre</label>
                <textarea name="message" rows="10" cols="50" >
                  <?php
                      if (!empty($_POST["message"]))
                      {
                          echo stripcslashes(htmlspecialchars($_POST["message"],ENT_QUOTES));
                      }
                  ?>
                </textarea>
                <script type="text/javascript">
                    CKEDITOR.replace( 'message' );// Mise en place de l'outil d'édition de texte précédement appelé
                </script>
                <button>Valider</button>
            </form>
        </div>
    </body>
</html>
