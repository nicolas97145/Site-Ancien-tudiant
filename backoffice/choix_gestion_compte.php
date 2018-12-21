<?php
    require_once('../frontoffice/connexionBD.php');
    if(empty($_SESSION['statut'])or $_SESSION['statut']!="Admin")
    {
        header('Location: ../frontoffice/authentification.php');
    }
    $_SESSION["page"] = "gestion";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/styleGestionCompte.css">
        <script src="../js/jquery-3.1.1.js" type="text/javascript"></script>
        <title>Gestion anciens étudiants</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Gestion des comptes
        </div>
        <div id="divPrincipal" class="box-principal">
            <h1>Création d'un compte</h1>
            <form id="form-creacompte" method="post" action="traitement/ajout_compte.php">
                <p>Quel type de compte va être créé ?</p>
                <select class="select" name="statut">
                    <option value="Utilisateur">Utilisateur</option>
                    <option value="Administrateur">Administrateur</option>
                </select>
                <input id="mail-creacompte" onChange="verifMailCreacompte();" placeholder="Mail *" name="mail" type="text" class="titre" required/>
                <span id="mail-creacompte-false" class="hide-span" ></span>
                <input id="mdp-creacompte" onchange="verifMdpCreacompte();" placeholder="Mot de passe *" name="mdp" type="password" class="titre" required/>
                <span id="mdp-creacompte-false" class="hide-span" ></span>
                <input id="name-creacompte" onchange="verifNomCreacompte();" placeholder="Nom *" name="nom" type="text" class="titre" required/>
                <span id="name-creacompte-false" class="hide-span" ></span>
                <input id="firstname-creacompte" placeholder="Prénom *" name="prenom" type="text" class="titre"/>
                <input id="date-creacompte" name="dateN" type="date" class="titre"/>
                <input id="submit-creacompte" type="submit" class="recherche-header" value="Créer le compte"/>
            </form>
        </div>
        <div id="divPrincipal" class="box-principal">
            <form method="post" action="traitement/modification_compte.php">
                <h1>Modification d'un compte</h1>
                <p>Quel compte va être modifié ? </p>
                <select class="select" name="id">
                    <?php
                        $etudiant="SELECT id, nom, prenom FROM etudiant";
                        $resultat = $connexion->query($etudiant);
                        while($ligne=$resultat->fetch()){
                          echo "<option value='".$ligne['id']."'>".$ligne['nom']." ".$ligne['prenom']."</option>";
                        }
                    ?>
                </select>
                <button>Modifier ce compte</button>
            </form>
        </div>
        <div id="divPrincipal" class="box-principal">
            <form method="post" action="traitement/suppression_compte.php">
                <h1>Suppression d'un compte</h1>
                <p>Quel compte va être supprimé ?</p>
                <select class="select" name="id">
                    <?php
                    $etudiant="SELECT id, nom, prenom FROM etudiant";
                    $resultat = $connexion->query($etudiant);
                    while($ligne=$resultat->fetch()){
                      echo "<option value='".$ligne['id']."'>".$ligne['nom']." ".$ligne['prenom']."</option>";
                    }
                    ?>
                </select>
                <button>Supprimer ce compte</button>
            </form>
            <script type="text/javascript" src="../js/script_gestion_compte.js"></script>
	       </div>
    </body>
</html>
