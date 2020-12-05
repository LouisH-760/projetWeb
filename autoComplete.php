<?php
    require_once("Donnees.inc.php");
    require_once("bob.php");
    require_once("searchAndAutoCompleteHelper.php");
    
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

    $selectedRecipes = array();
    
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
                //doesn't decide to add or not,
                //only there to count the point of a recipe with a wished ingredient
                $points += 1;
            }
            if (stringContainsFlexible($food, $query)) {
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
            array_push($selectedRecipes, $t);
        }
    }

    $selectedIngredients = array();
    $underHierarchy = getUnder($root, $Hierarchie);
    array_push($underHierarchy, $root);
    foreach($underHierarchy as $id => $ingredient) {
        if (stringContainsFlexible($ingredient, $query)) {
            if (! inArray($include, $query) && ! inArray($exclude, $query)) {
                array_push($selectedIngredients, $ingredient);
            }
        }
    }

    $selectedRecipes = sortByPoints($selectedRecipes);

    $selectedRecipes = crunchResults($selectedRecipes);

    $result = array("recipes" => $selectedRecipes, "ingredients" => $selectedIngredients);

    echo parseResults($result);
?>