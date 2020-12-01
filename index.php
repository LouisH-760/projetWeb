<?php 
  require_once("Donnees.inc.php"); 
  require_once('bob.php');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet</title>
  </head>
  <body>
    <?php
    $root = getRoot($Hierarchie)[0];
    if(!isset($_GET["params"])) {
      foreach($Hierarchie[$root]['sous-categorie'] as $souscat) {
        echo '<a href="index.php?params[]=' . $root . '&params[]=' . $souscat . '">' . $souscat . '</a><br>';
      }
      $current = $root;
    } else {
      $params = $_GET["params"];
      $current = end($params);
      $tmp = array();
      foreach($params as $param) {
        $currSlice = array_slice($params, 0, array_search($param, $params) + 1);
        $tmp[] = '<a href="index.php' . buildGetParams('params', $currSlice) . '">' . $param . '</a>';
      }
      echo implode(' > ', $tmp) . '<hr>';
      if(array_key_exists('sous-categorie', $Hierarchie[$current])) {
        foreach($Hierarchie[$current]['sous-categorie'] as $souscat) {
          echo '<a href="index.php' . buildGetParams('params', $params) . '&params[]=' . $souscat . '">' . $souscat . '</a><br>';
        }
      } else {
        echo $current;
      }
    }
    echo "<hr>";
    foreach(getAllRecipes(getNonSub($current, $Hierarchie), $Recettes) as $id) {
      echo '<a href="afficherecette.php?id=' . $id . '">' . $Recettes[$id]['titre'] . '</a><br>';
    }
    ?>
  </body>
</html>
