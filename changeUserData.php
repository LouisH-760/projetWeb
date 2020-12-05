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
    </nav>
    <main>
        <h1></h1>

        <form method="post" action="addUserData.php">

<?php
include 'userDataFunctions.php';

if (isset($_GET["login"])) {
    $login = $_GET["login"];
    $userData = json_decode(getUserData($login), true);
}

?>

            <fieldset>
                <legend>Données Personelles</legend>
                <div class="group optional">
                    Nom :
                    <input type="text" name="nom" value="<?php if (isset($userData)) {echo ($userData["nom"]);} ?>" class="fullwidth" placeholder="John"/>
                </div>
                <div class="group optional">
                    Prénom :
                    <input type="text" name="prenom" value="<?php if (isset($userData)) {echo $userData["prenom"];}?>" class="fullwidth" placeholder="Doe"/></div>
                <div class="group optional">
                    Vous êtes :
                    <label><input type="radio" name="sexe" value="f" <?php if (isset($userData)) {echo "checked = 'checked'";}?>/> femme</label>
                    <label><input type="radio" name="sexe" value="h" <?php if (isset($userData)) {echo "checked = 'checked'";}?>/> homme</label>
                </div>
                <div class="group optional">
                    Date de naissance :
                    <input type="date" name="naissance" value="<?php if (isset($userData)) {echo $userData["naissance"];}?>" class="fullwidth"/>
                </div>
            </fieldset>
            <fieldset>
                <legend>Adresse</legend>
                <div class="group optional">
                    Adresse :
                    <input type="text" name="adresse" value="<?php if (isset($userData)) {echo $userData["adresse"];}?>" class="fullwidth" placeholder="1, Avenue Example"/>
                </div>
                <div class="groupnp">
                    <div class="fullwidth">
                        <div class="cpwidth optional">
                            Code Postal :
                            <input type="text" name="adresseCP" value="<?php if (isset($userData)) {echo $userData["adresseCP"];}?>" class="fullwidth" placeholder="12345"/>
                        </div>
                        <div class="vwidth">
                            Ville :
                            <input type="text" name="adresseV" value="<?php if (isset($userData)) {echo $userData["adresseV"];}?>" class="fullwidth" placeholder="Example-sur-mer"/>
                        </div>
                    </div>
                </div>
            </fieldset>
            <input type="submit" value="Valider" />
        </form>
    </main>
</body>

</html>