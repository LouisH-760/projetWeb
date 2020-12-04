<?php
    require_once("Donnees.inc.php");
    require_once("bob.php");
    require_once("searchAndAutoCompleteHelper.php");


    function testInclude($include, $food) {
        return $include !== false && inArray($include, $food);
    }

    function testExclude($exclude, $food) {
        return $exclude !== false && inArray($exclude, $food);
    }

    function testQuery($title, $query) {
        return $query !== false && stringContainsFlexible($title, $query);
    }

    function parseResults($results) {
        $result = array("results" => array());
        $result["results"] = $results;
        $result = json_encode($result);
        return $result;
    }

    $include = false;
    if (isset($_GET["include"])) {
        $include = $_GET["include"];
    } 

    $exclude = false;
    if (isset($_GET["exclude"])) {
        $exclude = $_GET["exclude"];
    } 

    $query = false;
    if (isset($_GET["query"])) {
        $query = $_GET["query"];
    } 

    if (isset($_GET["root"])) {
        $root = $_GET["root"];
    } else {
        $root = getRoot($Hierarchie)[0];
    }

    $result = array();
    $recipes = getRecipes($root, $Hierarchie, $Recettes);
    foreach($recipes as $recipeID => $recipe){
        // for each include, exclude, query 
        $shoudExclude = false;
        $add = false;
        foreach($recipe["index"] as $foodID => $food) {
            if (testExclude($exclude, $food)) {
                $shoudExclude = true;
                break;
            }
            if (testInclude($include, $food)) {
                $add = true;
            }
        }
        if (testQuery($recipe["titre"], $query)) {
            $add = true;
        }
        if (! $shoudExclude && $add) {
            array_push($result, $recipeID);
        }
    }

    echo parseResults($result);
?>