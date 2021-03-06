<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscriptions</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/forms.css">
    <link rel="stylesheet" href="style/register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php" id="mainlink">Retour à l'accueil</a></li>
        </ul>
    </nav>
    <main>
        <h1>Créer un profil utilisateur</h1>
        <form method="post" action="addUserData.php">
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
                <div class="group optional">
                    Mail :
                    <input type="text" name="mail" class="fullwidth" placeholder="john@example.com"/>
                </div>
            </fieldset>
            <fieldset>
                <legend>Données Personelles</legend>
                <div class="group optional">
                    Nom :
                    <input type="text" name="nom" class="fullwidth" placeholder="John"/>
                </div>
                <div class="group optional">
                    Prénom :
                    <input type="text" name="prenom" class="fullwidth" placeholder="Doe"/></div>
                <div class="group optional">
                    Vous êtes :
                    <label><input type="radio" name="sexe" value="f" /> femme</label>
                    <label><input type="radio" name="sexe" value="h" /> homme</label>
                </div>
                <div class="group optional">
                    Date de naissance :
                    <input type="date" name="naissance" class="fullwidth"/>
                </div>
            </fieldset>
            <fieldset>
                <legend>Adresse</legend>
                <div class="group optional">
                    Adresse :
                    <input type="text" name="adresse" class="fullwidth" placeholder="1, Avenue Example"/>
                </div>
                <div class="groupnp">
                    <div class="fullwidth">
                        <div class="cpwidth optional">
                            Code Postal :
                            <input type="text" name="adresseCP" class="fullwidth" placeholder="12345"/>
                        </div>
                        <div class="vwidth">
                            Ville :
                            <input type="text" name="adresseV" class="fullwidth" placeholder="Example-sur-mer"/>
                        </div>
                    </div>
                </div>
            </fieldset>
            <input type="submit" value="Valider" />
        </form>
        <p class="login">
            Vous avez déja un compte? <a href="Login.php">Se connecter</a>
        </p>
    </main>
</body>
</html>