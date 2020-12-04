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
        $result = strpos($haystack, $needle) !== false;
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
?>