<!DOCTYPE html>
<html lang="fr">

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/register.css">
</head>

<body>

    <nav>
        <a href="index.php" id="mainlink">Retour à l'accueil</a>
    </nav>
    <main>
        <h1>Créer un profil utilisateur</h1>

        <form method="post" action="Verif.php">
            <fieldset>
                <legend>Utilisateur</legend>
                <div class="group required">
                    Login :
                    <input type="text" name="login" required="required" class="fullwidth" />
                </div>
                <div class="group required">
                    Mot de passe :
                    <input type="text" name="passe" required="required" class="fullwidth" />
                </div>
                <div class="group optional">
                    Mail :
                    <input type="text" name="mail" class="fullwidth" />
                </div>
            </fieldset>
            <fieldset>
                <legend>Données Personelles</legend>
                <div class="group optional">
                    Nom :
                    <input type="text" name="nom" class="fullwidth" />
                </div>
                <div class="group optional">
                    Prénom :
                    <input type="text" name="prenom" class="fullwidth" /></div>
                <div class="group optional">
                    Vous êtes :
                    <label><input type="radio" name="sexe" value="f" /> femme</label>
                    <label><input type="radio" name="sexe" value="h" /> homme</label>
                </div>
                <div class="group optional">
                    Date de naissance :
                    <input type="date" name="naissance" class="fullwidth" />
                </div>
            </fieldset>
            <fieldset>
                <legend>Adresse</legend>
                <div class="group optional">
                    Adresse :
                    <input type="text" name="adresse" class="fullwidth" />
                </div>
                <div class="group optional">
                    <div class="fullwidth">
                        <div class="cpwidth">
                            Code Postal :
                            <input type="text" name="adresseCP" class="fullwidth" />
                        </div>
                        <div class="vwidth">
                            Ville :
                            <input type="text" name="adresseV" class="fullwidth" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <input type="submit" value="Valider" />
        </form>
    </main>
</body>

</html>