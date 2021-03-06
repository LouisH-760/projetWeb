<!DOCTYPE html>
<html lang="fr">

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/login.css">
</head>

<body>

    <nav>
        <a href="index.php" id="mainlink">Retour à l'accueil</a>
        
    </nav>
    <main>
        <h1>Se connecter</h1>

        <form method="post" action="changeUserData.php">
            <fieldset>
                <legend>Utilisateur</legend>
                <div class="group required tooltip">
                    Login :
                    <input type="text" name="login" required="required" class="fullwidth" placeholder="john123"/>
                    <span class="tooltiptext">Champ obligatoire</span>
                </div>
                <div class="group required tooltip">
                    Mot de passe :
                    <input type="password" name="passe" required="required" class="fullwidth" />
                    <span class="tooltiptext">Champ obligatoire</span>
                </div>
            </fieldset>
            <input type="submit" value="Valider" />
        </form>
        <p>
            Pas encore de compte? <a href="FirstLogin.php" id="mainlink">S'inscrire</a>
        </p>
    </main>
</body>

</html>
