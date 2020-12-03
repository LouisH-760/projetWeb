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
$matchingRecipes = getAllRecipes(getUnder($current, $Hierarchie), $Recettes);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/main.css">
  <link rel="stylesheet" href="style/index.css">

  <!-- Google fonts WOOOOOOOOOOOOo -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
  <title>Projet</title>
</head>

<body>
  <?php
  // display the navigation thread
  echo '<nav>Catégorie: ' . implode(' > ', $ariane) . '</nav>';
  // if the category we are on has subcategories, display them
  if (array_key_exists('sous-categorie', $Hierarchie[$current])) {
    echo '<div class="subcats"><ul>';
    foreach ($Hierarchie[$current]['sous-categorie'] as $souscat) {
      echo '<li><a href="index.php' . buildGetParams('params', $params) . '&params[]=' . $souscat . '">' . $souscat . '</a></li>';
    }
    echo '</ul></div>';
  } else { // else, show the category name
    echo '<div class="subcats"><h2>Cocktail(s) contenant: ' . $current . '</h2></div>';
  }
  ?>
    <div class="search">
      <form action="#">
        <input type="text" name="searchbar" id="searchbar" placeholder="Mojito">
        <input type="submit" value="Rechercher">
      </form>
      <hr>
      <a href="#">Recherche avancée</a>
    </div>
  <div class="recettes">
    <?php
    // show recipes for the current category
    echo '<ul>';
    foreach ($matchingRecipes as $id) {
      echo '<li><a href="afficherecette.php?id=' . $id . '">' . $Recettes[$id]['titre'] . '</a></li>';
    }
    echo '</ul>';
    ?>
  </div>
</body>

</html>