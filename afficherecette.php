<?php
    require_once("Donnees.inc.php");
    if(!isset($_GET["id"])) {
        // change me
        Header("Location: index.php");
    }
    $id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette</title>
</head>
<body>
    <?php print_r($Recettes[$id]); ?>
</body>
</html>