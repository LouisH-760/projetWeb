<?php
    require_once("Data/Donnees.inc.php");
    require_once("Helpers/dataRepHelper.php");
    require_once("Helpers/searchAndAutoCompleteHelper.php");

    $include = false;
    if (isset($_GET["include"])) {
        $include = $_GET["include"];
        $include = completeWithUnder($include, $Hierarchie);
    }

    $exclude = false;
    if (isset($_GET["exclude"])) {
        $exclude = $_GET["exclude"];
        $exclude = completeWithUnder($exclude, $Hierarchie);
    }

    $query = false;
    if (isset($_GET["query"])) {
        $query = $_GET["query"];
        $query = implode("", $query);
    } 

    if (isset($_GET["root"])) {
        $root = $_GET["root"];
    } else {
        $root = getRoot($Hierarchie)[0];
    }

    $recipes = getRecipes($root, $Hierarchie, $Recettes);

    $result = array();
    
    foreach($recipes as $recipeID => $recipe){
        $shoudExclude = false;
        $add = false;
        $points = 0;
        foreach($recipe["index"] as $foodID => $food) {
            if (testIngredient($exclude, $food)) {
                $shoudExclude = true;
                break;
            }
            if (testIngredient($include, $food)) {
                $add = true;
                $points += 1;
            }
        }
        if (testQuery($recipe, $query)) {
            $add = true;
            $points += 1;
        }
        if (! $shoudExclude && $add) {
            $t = array();
            $t["id"] = $recipeID;
            $t["points"] = $points;
            array_push($result, $t);
        }
    }

    $result = sortByPoints($result);

    $result = crunchResults($result);

    echo parseResults($result);
?>