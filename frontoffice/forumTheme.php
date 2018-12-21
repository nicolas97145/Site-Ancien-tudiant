<?php
    session_start();
    if(empty($_SESSION['statut'])||!isset($_GET['theme'])||empty($_GET['theme']))
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "forum";

    require_once('connexionBD.php');

    $select_theme=$connexion->query('SELECT * FROM theme WHERE id = '.$_GET['theme']);
    $get_theme=$select_theme->fetch();
    if(isset($_POST['libelle'])&&!empty($_POST['libelle'])&&isset($_POST['sujet'])&&!empty($_POST['sujet'])){
      $inserer=$connexion->query('INSERT INTO sujet VALUES(null,"'.date("Y-m-d H:i:s").'","'.$_POST['libelle'].'","'.$_POST['sujet'].'",'.$_SESSION['idCompte'].','.$_GET['theme'].')');
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleForum.css" />
        <script type="text/javascript" src="../js/forum.js"></script>
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script><!-- Script pour l'outil d'édition de texte -->
        <title>Forum</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » <a href="../frontoffice/forum.php">Forum</a> » <?php echo $get_theme['libelle']; ?>
        </div>

        <!--  Recherché un nouveau sujet -->
        <div class="box-forum">
            <input id="recherche" type="recherche" placeholder="Rechercher dans le forum"/>
            <select id="cat" name="cat">
                <option value="Sujet">Sujet</option>
                <option value="Auteur">Auteur</option>
            </select>
            <button onclick="test(<?php echo $_GET['theme']; ?>);">Rechercher</button>
        </div>

        <!--  Accéder à un sujet -->
        <div class="box-forum" id="select-sujet">
            <table>
                <tr>
                    <td>Sujet</td>
                    <td>Auteur</td>
                    <td>NB</td>
                </tr>
            <?php
                $rq=$connexion->query('select distinct s.id as "idsujet", e.nom as "nom", e.prenom as "prenom", s.libelle as "libelle", e.id as "id" from etudiant e, sujet s where e.id = s.id_etudiant AND s.id_Theme = '.$_GET['theme']);
                while($ligne=$rq->fetch()){
                    echo "<tr>";
                    echo "<td><a href='forumSujet.php?sujet=".$ligne['idsujet']."'>".$ligne['libelle']."</a></td>";
                    echo "<td><a href='affiche_profil.php?id=".$ligne['id']."'>".$ligne['nom']." ".$ligne['prenom']."</a></td>";
                    $chercheNombre=$connexion->query('select count(*) as "nb" from post where id_sujet = '.$ligne['idsujet']);
                    $get=$chercheNombre->fetch();
                    echo "<td>".$get['nb']."</td>";
                    echo "</tr>";
                }
            ?>
            </table>
        </div>

        <!--  Créer un nouveau sujet -->
        <div class="box-forum">
            <form action="forumTheme.php?theme=<?php echo $_GET['theme']; ?>" method="POST">
                <label>Titre du sujet</label>
                <input type="text" name="libelle"/>
                <textarea name="sujet" rows="10" cols="50" >
                  <?php
                      if (!empty($_POST["sujet"]))
                      {
                          echo stripcslashes(htmlspecialchars($_POST["sujet"],ENT_QUOTES));
                      }
                  ?>
                </textarea>
                <script type="text/javascript">
                    CKEDITOR.replace( 'sujet' );// Mise en place de l'outil d'édition de texte précédement appelé
                </script>
                <button>Valider</button>
            </form>
        </div>
    </body>
</html>
