<?php
// Get the "root" of the Hierarchie array
function getRoot($array)
{
    $tmp = array();
    foreach ($array as $name => $value) {
        if (!array_key_exists('super-categorie', $value)) {
            $tmp[] = $name;
        }
    }
    return $tmp;
}

// Get a get-parameter string from an array
function buildGetParams($prefix, $array)
{
    $tmp = array();
    foreach ($array as $key => $value) {
        $tmp[] = $prefix . '[' . $key . ']=' . $value;
    }

    return '?' . implode("&", $tmp);
}

// Get all subcategories for a given element in a recursive manner
function getUnder($root, $array)
{
    if (array_key_exists('sous-categorie', $array[$root])) {
        $tmp = array();
        foreach ($array[$root]['sous-categorie'] as $souscat) {
            $tmp[] = $souscat;
            $tmp = array_merge($tmp, getUnder($souscat, $array));
        }
        return $tmp;
    } else {
        return array($root);
    }
}

// Get the supercategories for an array (determine a path to the "root") recursively
function getTree($leaf, $array)
{
    if (!array_key_exists('super-categorie', $array[$leaf])) {
        return array($leaf);
    } else {
        return array_merge(getTree(end($array[$leaf]['super-categorie']), $array), array($leaf));
    }
}

// get all the recipes that have at least one ingredient in a given array
function getAllRecipes($ingredients, $array)
{
    $tmp = array();
    foreach ($array as $id => $recette) {
        foreach ($ingredients as $ingredient) {
            if (in_array($ingredient, $recette['index'])) {
                $tmp[] = $id;
                break;
            }
        }
    }
    return $tmp;
}

// Normalize a string: replace accents with non-accented char, remove special characters, replace spaces by _
function normalizeText($str)
{
    // remove the accents
    $unwanted_array = array(
        'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
        'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
        'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
    );
    $str = strtr($str, $unwanted_array);
    // make every first word uppercase
    $str = ucfirst(strtolower($str));
    // remove other extraneous chars
    $str = preg_replace("/[^a-zA-Z ]/", "", $str);
    return implode('_', explode(' ', $str));
}
?>
<!-- Formerly named bob, should have been migrated successfully -->