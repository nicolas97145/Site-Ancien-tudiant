<?php
    require_once('../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin")
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $_SESSION["page"] = "gestion";
    $select_actualites = $connexion->query('Select idNews,titre from news');
    $select_actualites2 = $connexion->query('Select idNews,titre from news');
?>
<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleGestionActualite.css">
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script><!-- Script pour l'outil d'édition de texte -->
    <script type="text/javascript" src="../js/image.js"></script>
     <title>Ajouter une actualité</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Gestion des actualités
        </div>

        <!--- Zone d'ajout d'article --->
        <div id="divPrincipal" class="box-principal">
            <h1>Ajout d'une actualité</h1>
            <form action="traitement/ajout_actualite.php" id="ajout" method="POST" name="formulaire">
                <!-- Champ titre -->
                <p>Titre de l'actualité</p>
                <p id="erreurtitre"></p>
                <input name="titre" type="text" class="titre" required/>

                 <!-- Liste catégorie -->
                <p>
                    <p>Catégorie</p>
                    <select name="categorie" class="select">
                        <option value="lycee">Lycée</option>
                        <option value="mariage">Mariage</option>
                        <option value="deces">Décés</option>
                        <option value="naissance">Naissance</option>
                    </select>
                </p>

                <!-- Champ contenue -->
                <p>Contenu de la page</p>
                    <textarea name="contenu" rows="10" cols="50" >
                        <?php
                            if (!empty($_POST["contenu"]))
                            {
                                echo stripcslashes(htmlspecialchars($_POST["contenu"],ENT_QUOTES));
                            }
                        ?>
                    </textarea>
                <script type="text/javascript">
                    CKEDITOR.replace( 'contenu' );// Mise en place de l'outil d'édition de texte précédement appelé
                </script>

                <!-- Champ ajout d'image -->
                <!--<div class="input-file-container">
                    <input class="input-file" id="my-file" type="file">
                    <label for="my-file" class="input-file-trigger" tabindex="0">Select a file...</label>
                </div>
                <p class="file-return"></p>-->
                    <!--<input type="file" name="fichier"/>


                 Boutons -->
                <br>
                <button>Valider</button>
            </form>
        </div>

        <!--- Zone de modification d'article --->
        <div id="divPrincipal" class="box-principal">
            <h1>Modification d'une actualité</h1>
            <form method="post" action="traitement/modification_actualite.php">

                <!-- Liste modifier article -->
                <p>Quel article voulez vous modifier  ?</p>
                <select name="article_modif" class="select">
                    <?php
                        while($lgn = $select_actualites->fetch())
                        {
                            echo '<option value="'.$lgn["idNews"].'">'.$lgn["titre"].'</option>';
                        }
                    ?>
                </select>

                <!-- Boutons -->
                <button>Modifier l'actualité</button>

            </form>
        </div>

        <!--- Zone de suppression d'article --->
        <div id="divPrincipal" class="box-principal">
            <h1>Suppression d'une actualité</h1>
            <form method="post" action="traitement/suppression_actualite.php">

                <!-- Liste supprimer article -->
                <p>Quel article voulez vous supprimer ?</p>
                <select name="article_suppr" class="select">
                    <?php
                        while($lgn = $select_actualites2->fetch())
                        {
                            echo '<option value="'.$lgn["idNews"].'">'.$lgn["titre"].'</option>';
                        }
                    ?>
                </select>

                <!-- Boutons -->
                <button>Supprimer l'actualité</button>

            </form>
        </div>
        <?php include '../frontoffice/footer.php'; ?>
    </body>
</html>
