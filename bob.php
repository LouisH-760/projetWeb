<?php
    function getRoot($array) {
        $tmp = array();
        foreach($array as $name=>$value) {
          if(!array_key_exists('super-categorie', $value)) {
              $tmp[] = $name;
            }
        }
        return $tmp;
    }

    function buildGetParams($prefix, $array) {
        $tmp = array();
        foreach($array as $key => $value) {
            $tmp[] = $prefix . '[' . $key . ']=' . $value;
        }

        return '?' . implode("&", $tmp);
    }

    function getNonSub($root, $array) {
        if(array_key_exists('sous-categorie', $array[$root])) {
            $tmp = array();
            foreach($array[$root]['sous-categorie'] as $souscat) {
                $tmp = array_merge($tmp, getNonSub($souscat, $array));
            }
            return $tmp;
        } else {
            return array($root);
        }
    }

    function getAllRecipes($ingredients, $array) {
        $tmp = array();
        foreach($array as $id=>$recette) {
            foreach($ingredients as $ingredient) {
                if(in_array($ingredient, $recette['index'])) {
                    $tmp[] = $id;
                    break;
                }
            }
            if(count($tmp) > 25) {
                return $tmp;
            }
        }
        return $tmp;
    }
?>