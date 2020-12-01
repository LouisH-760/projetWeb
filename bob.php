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

    function getTree($leaf, $array) {
        if(!array_key_exists('super-categorie', $array[$leaf])){
            return array($leaf);
        } else {
            return array_merge(getTree(end($array[$leaf]['super-categorie']), $array), array($leaf));
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
            // uncomment those lines to reinstate the result limit
            /*if(count($tmp) > 25) {
                return $tmp;
            }*/
        }
        return $tmp;
    }

    function normalizeText($str) {
        // remove the accents
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y');
        $str = strtr( $str, $unwanted_array );
        // make every first word uppercase
        $str = ucfirst(strtolower($str));
        // remove other extraneous chars
        $str = preg_replace("/[^a-zA-Z ]/", "", $str);
        return implode('_', explode(' ', $str));
    }
?>