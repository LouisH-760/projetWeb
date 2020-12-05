<?php

    function replaceSpecialChars($str) {
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y');
        $result = strtr( $str, $unwanted_array );
        return $result;
    }

    function simplifyText($str) {
        $result = strtolower($str);
        $result = replaceSpecialChars($result);
        return $result;
    }

    function stringEqualsFlexible($a, $b){
        return simplifyText($a) == simplifyText($b);
    }

    function stringContainsFlexible($haystack, $needle) {
        $needle = simplifyText($needle);
        $haystack = simplifyText($haystack);
        $result = ($needle != "" && strpos($haystack, $needle) !== false) || stringEqualsFlexible($haystack, $needle);
        return $result;
    }

    //case proof
    function inArray($haystack, $needle) {
        foreach ($haystack as $element) {
            if (stringEqualsFlexible($element, $needle)) {
                return true;
            }
        }
        return false;
    }

    function testIngredient($arrayToTest, $ingredient) {
        return $arrayToTest !== false && inArray($arrayToTest, $ingredient);
    }

    function testQuery($recipe, $query) {
        if ($query === false) {
            return false;
        }
        if (stringContainsFlexible($recipe["titre"], $query)) {
            return true;
        }
        foreach($recipe["index"] as $id => $ingredient) {
            if (stringContainsFlexible($ingredient, $query)) {
                return true;
            }
        }
        return false;
    }

    function normalizeKeys($keys, $hierarchy) {
        $result = array();
        foreach($hierarchy as $k => $v) {
            if (inArray($keys, $k)) {
                array_push($result, $k);
            }
        }
        return $result;
    }

    function getRecipes($root, $hierarchy, $allRecipes) {
        $ingredients = getUnder($root, $hierarchy);
        array_push($ingredients, $root);
        $ids = getAllRecipes($ingredients, $allRecipes);
        $result = array();
        foreach($ids as $id) {
            $result[$id] = $allRecipes[$id];
        }
        return $result;
    }

    function completeWithUnder($toComplete, $hierarchy) {
        $toComplete = normalizeKeys($toComplete, $hierarchy);
        $result = $toComplete;
        foreach($toComplete as $element) {
            $under = getUnder($element, $hierarchy);
            foreach($under as $u) {
                if ( ! inArray($result, $u)) {
                    array_push($result, $u);
                }
            }
        }
        return $result;
    }

    function sortByPoints($array){
        //bubble sort
        $size = sizeof($array);
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i - 1; $j++) {
                if ($array[$j]["points"] < $array[$j + 1]["points"]) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j+1];
                    $array[$j+1] = $temp;
                }
            }
        }
        return $array;
    }

    function crunchResults($array) {
        $result = array();
        foreach($array as $id => $element) {
            array_push($result, $element["id"]);
        }
        return $result;
    }

    function parseResults($results) {
        $result = array("results" => array());
        $result["results"] = $results;
        $result = json_encode($result);
        return $result;
    }
?>