<?php 
    session_start();
    if(empty($_SESSION['statut'])) 
    {
        header('Location: authentification.php');
    }
    $_SESSION["page"] = "accueil";
    require_once('connexionBD.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/styleProfil.css">
        <title></title>
    </head>
    <body>
        
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?> 
        <!--- Zone fil ariane --->
        <div class="filAriane">
            <a href="../frontoffice/accueil.php">Accueil</a> » Profil
        </div>
        <div id="divPrincipal" class="box-principal">      
            <form>
                <div id='divSecondaire' class='box-Secondaire'> 
                    <h1><span class="number" id="number1">1</span>Vous êtes :</h1>    
                    <input  type="text" class ="titre" name="champ1" id="champ1" placeholder="Nom" required>
                    <br /><br />
                    <input type="text" class ="titre" name="champ2" id="champ2" placeholder="Prenom" required>
                    <br /><br />
                    <input type="date" class ="titre" name="champ3" id="champ3" placeholder="Date de naissance" required>
                </div>
                
                <div id='divSecondaire' class='box-Secondaire'> 
                    <h1><span class="number" id="number2">2</span>Passage dans l'établissement</h1>
                    <p>Année d'entrée</p>
                    <select class="select" required>
                        <option value="">A renseigner</option>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                    <br /><br />
                    <p>Année de sortie</p>
                    <select class="select" required>
                        <option value="">A renseigner</option>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                    <br /><br />
                    <p>Cursur suivis</p>
                    <select class="select" required>
                        <option value="">A renseigner</option>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                
                <div id='divSecondaire' class='box-Secondaire'>
                    <h1><span class="number" id="number3">3</span>Comment vous contacter?</h1>
                    <input type="text" class ="titre" name="champ1" id="champ1" placeholder="Adresse" required>
                    <br /><br />
                    <input type="text" class ="titre" name="champ2" id="champ2" placeholder="Code postal" required>
                    <br /><br />
                    <input type="text" class ="titre" name="champ3" id="champ3" placeholder="Ville" required>
                    <br /><br />
                    <input type="tel" class ="titre" name="champ3" id="champ3" placeholder="Téléphone fixe" required>
                </div>
                
                <button class="bouton">Valider</button>
            </form>
        </div>
 </body>
</html>
