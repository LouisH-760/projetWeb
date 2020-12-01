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

    
?>