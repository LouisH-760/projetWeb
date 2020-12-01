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
    } else {
      $params = $_GET["params"];
      $current = end($params);
      if(array_key_exists('sous-categorie', $Hierarchie[$current])) {
        foreach($Hierarchie[$current]['sous-categorie'] as $souscat) {
          echo '<a href="index.php' . buildGetParams('params', $params) . '&params[]=' . $souscat . '">' . $souscat . '</a><br>';
        }
      }
    }
    ?>
  </body>
</html>
