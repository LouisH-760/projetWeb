<?php
define("EXTENSION", ".jpg");
require_once("Donnees.inc.php");
require_once("bob.php");
// if the id isn't set, do something
// eventually check if the id exists?
if (!isset($_GET["id"])) {
    // change me
    Header("Location: index.php");
}
// get stuff
$id = $_GET["id"];
$titre = $Recettes[$id]['titre'];
$ingredients = explode('|', $Recettes[$id]['ingredients']);
$préparation = $Recettes[$id]['preparation'];
$tags = array();
foreach ($Recettes[$id]['index'] as $elem) {
    $tags[] = '<a href="index.php' . buildGetParams('params', getTree($elem, $Hierarchie)) . '">' . $elem . '</a>';
}
// generate the eventual image name
$image = "Photos/" . normalizeText($titre) . EXTENSION;
// if it actually exists, add it to the page
// otherwise, NULL
$imgContainer = (file_exists($image)) ? '<div class="image"><p><h2>Image</h2><img src="' . $image . '" alt="' . $titre . '" /></p></div>' : NULL;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
</head>

<body>
    <p>
        <h1><?php echo $titre; ?></h1>
        <a href="index.php">Retour à l'acceuil</a>
        <h2>Ingrédients</h2>
        <ul class="ingrédients">
            <?php
            foreach ($ingredients as $ingredient) {
                echo '<li>' . $ingredient . '</li>';
            }
            ?>
        </ul>
    </p>
    <p>
        <h2>Instructions</h2>
        <?php echo $préparation; ?>
    </p>
    <p>
        <?php echo $imgContainer; ?>
    </p>
    <footer>
        <h2>Tags</h2>
        <p>
            <?php
            echo implode(", ", $tags);
            ?>
        </p>
    </footer>
</body>

</html>