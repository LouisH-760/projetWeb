<?php
require_once("Donnees.inc.php");
require_once('bob.php');
$root = getRoot($Hierarchie)[0];

// if there is no params array, create it
if (!isset($_GET["params"])) {
  $params = array($root);
  $current = $root;
} else { // else, actually get it
  $params = $_GET["params"];
  $current = end($params);
}

// compute the navigation thread from the params array
$ariane = array();
foreach ($params as $param) {
  $currSlice = array_slice($params, 0, array_search($param, $params) + 1);
  $ariane[] = '<a href="index.php' . buildGetParams('params', $currSlice) . '">' . $param . '</a>';
}

// get the matching recipes
$matchingRecipes = getAllRecipes(getNonSub($current, $Hierarchie), $Recettes);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Projet</title>
</head>

<body>
  <?php
  // display the navigation thread
  echo '<nav>Catégorie: ' . implode(' > ', $ariane) . '<hr>' . '<nav>';
  // if the category we are on has subcategories, display them
  if (array_key_exists('sous-categorie', $Hierarchie[$current])) {
    echo '<h2> Je veux un cocktail contenant:</h2>';
    foreach ($Hierarchie[$current]['sous-categorie'] as $souscat) {
      echo '<a href="index.php' . buildGetParams('params', $params) . '&params[]=' . $souscat . '">' . $souscat . '</a><br>';
    }
    echo "<hr>";
  } else { // else, show the category name
    echo '<h2>Cocktail(s) contenant: ' . $current . '</h2>';
  }
  // show recipes for the current category
  foreach ($matchingRecipes as $id) {
    echo '<a href="afficherecette.php?id=' . $id . '">' . $Recettes[$id]['titre'] . '</a><br>';
  }
  ?>
</body>

</html>