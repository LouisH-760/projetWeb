<?php
    require_once("Donnees.inc.php");
    require_once("bob.php");

    function stringEqualsCaseProof($a, $b){
        return strtolower($a) == strtolower($b);
    }

    //case proof
    function inArray($needle, $haystack) {
        foreach ($haystack as $element) {
            if (stringEqualsCaseProof($element, $needle)) {
                return true;
            }
        }
        return false;
    }

    function testInclude($food, $include) {
        return $include !== false && inArray($food, $include);
    }

    function testExclude($food, $exclude) {
        return $exclude !== false && inArray($food, $exclude);
    }

    function parseResults($results) {
        $result = array("results" => array());
        $result["results"] = $results;
        $result = json_encode($result);
        return $result;
    }

    function getRecipes($root, $hierarchy, $allRecipes) {
        $ingredients = getUnder($root, $hierarchy);
        $result = getAllRecipes($ingredients, $allRecipes);
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
    foreach($Recettes as $recipeID => $recipe){
        // for each include, exclude, query 
        $shoudExclude = false;
        $add = false;
        foreach($recipe["index"] as $foodID => $food) {
            if (testExclude($food, $exclude)) {
                $shoudExclude = true;
                break;
            }
            if (testInclude($food, $include)) {
                $add = true;
            }
        }
        if (! $shoudExclude && $add) {
            array_push($result, $recipeID);
        }
    }

    echo parseResults($result);
?>