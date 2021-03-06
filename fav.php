<?php
session_start();
if (!(isset($_SESSION["logged"])) || $_SESSION["logged"] != true) {
    header("Location: Login.php");
} else {
    $login = $_SESSION["login"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Mes Favoris</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Scripts/fav.js" defer></script>
</head>
<body>
    <input type="hidden" class="hidden" value="<?php echo $login; ?>" id="login">
    <nav>
        <ul>
            <li><a href="changeUserData.php">Mes informations utilisateur</a></li>
            <li><a href="index.php">Retourner à l'accueil</a></li>
            <li><a href="disconnect.php">Se déconnecter</a></li>
        </ul>
    </nav>
    <main>
        <h1>Mes recettes favorites</h1>
        <div id="container">
        </div>
    </main>
</body>
</html>