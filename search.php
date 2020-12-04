<?php
    require_once("Donnees.inc.php");
    require_once("bob.php");
    require_once("searchAndAutoCompleteHelper.php");

    function parseResults($results) {
        $result = array("results" => array());
        $result["results"] = $results;
        $result = json_encode($result);
        return $result;
    }

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

    $result = array();
    $recipes = getRecipes($root, $Hierarchie, $Recettes);
    foreach($recipes as $recipeID => $recipe){
        $shoudExclude = false;
        $add = false;
        foreach($recipe["index"] as $foodID => $food) {
            if (testIngredient($exclude, $food)) {
                $shoudExclude = true;
                break;
            }
            if (testIngredient($include, $food)) {
                $add = true;
            }
        }
        if (testQuery($recipe, $query)) {
            $add = true;
        }
        if (! $shoudExclude && $add) {
            array_push($result, $recipeID);
        }
    }

    echo parseResults($result);
?>