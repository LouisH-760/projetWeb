<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
</head>

<body>

    <h1></h1>

    <form method="post" action="Verif.php">
        <fieldset>
            <legend>Informations</legend>

            Login :
            <input type="text" name="login" required="required" /><br />
            Mot de passe :
            <input type="text" name="passe" required="required" /><br />
            Nom :
            <input type="text" name="nom" /><br />
            Prénom :
            <input type="text" name="prenom" /><br />
            Vous êtes :
            <label><input type="radio" name="sexe" value="f" /> femme</label>
            <label><input type="radio" name="sexe" value="h" /> homme</label>
            <br />
            Mail :
            <input type="text" name="mail" /><br />
            Date de naissance :
            <input type="date" name="naissance" /><br />
            Adresse :
            <input type="text" name="adresse" /><br />
            Adresse CP :
            <input type="text" name="adresseCP" /><br />
            Adresse Ville :
            <input type="text" name="adresseV" /><br />


        </fieldset>


        <br />
        <input type="submit" value="Valider" />

    </form>
</body>

</html>