<?php
	if (isset($_SESSION['deco'])){
		session_destroy();
	}
    session_start();
    $_SESSION['statut']="0";
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <link rel="stylesheet" href="../css/styleConnexion.css">
    </head>
    <body>
        <header>
            <!-- Entête de la zone considérée -->
            <a>
                <img src="../images/logostpaul.png" alt="logo" title="logo" id="logo" />
            </a>
        </header>
        <div class="login-page">
            <div class="form">
                <form method="post" action="authentificationBD.php" class="login-form">
                    <input type="text" name="Mail" placeholder="Mail" required/>
                    <input type="password" name="Password" placeholder="Mot de passe" id="password" required/>
                    <button>Authentification</button>
                   <!-- <p class="message">Mot de passe oublié ? <a href="#">Cliquer ici</a></p>-->
                </form>
            </div>
        </div>
    </body>
</html>
