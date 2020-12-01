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
$id = intval($_GET["id"]);
$prev = ($id >= 1) ? $id - 1 : $id;
$next = ($id <= count($Recettes) - 2) ? $id + 1 : $id;
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

    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/recette.css">

    <!-- Google fonts WOOOOOOOOOOOOo -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">

    <title><?php echo $titre; ?></title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="afficherecette.php?id=<?php echo $prev; ?>">&lt; Recette Précédente</a></li>
            <li><a href="index.php" id="mainlink">Retour à l'accueil</a></li>
            <li><a href="afficherecette.php?id=<?php echo $next; ?>">Recette Suivante &gt;</a></li>
        </ul>
    </nav>
    <main>
        <p>
            <h1><?php echo $titre; ?></h1>
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
    </main>
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