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
  <!-- To continue on our Google spree, Google-hosted jQuery WOOOOOOOOOOOOOOOOOOOOOOo -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- search script -->
  <!-- using defer so it is loaded when everything else is done -->
  <!-- https://pyxis.nymag.com/v1/imgs/d6a/dc7/4a5001b7beea096457f480c8808572428b-09-roll-safe.rsquare.w700.jpg -->
  <script src="search.js" defer></script>
  <title>Projet</title>
</head>

<body>
  <nav>

    <!-- display the navigation "thread" -->
    <?php echo 'Catégorie: ' . implode(' > ', $ariane); ?>
    <!-- login / favourites -->
    <!-- TODO add check if the user is logged in in the head and replace by variable? -->
    <a href="Login.php" class="connection">Se connecter</a>
  </nav>
  <?php
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
    <form autocomplete="off" action="#">
      <div class="autocomplete">
        <input type="text" name="searchbar" id="searchbar" placeholder="Mojito">
      </div>
      <!-- Hidden input with the current position -->
      <input type="hidden" class="hidden" value="<?php echo $current; ?>" id="currentVal">
      <!-- We pull the results using jQuery. The form MUST NOT BE SUBMITTED! -->
      <!-- keeping the search query is useful -->
      <button type="button" id="search">Rechercher</button>
    </form>
    <hr>
    <a href="help.html">Aide à la recherche</a>
  </div>
  <div class="recettes" id="mainContainer">
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