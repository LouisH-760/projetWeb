<?php
include 'favouriteFunctions.php';
if (isset($_GET['login']) && isset($_GET['id'])) {
    $login = $_GET['login'];
    $id = $_GET['id']; 
    
    $favs = getFavsFromUser($login);

    for ($i = 1; $i < sizeof($favs, 0); $i++) {
        if (strcmp($favs[$i], $id) == 0) {
            unset($favs[$i]);
        }
    }
    
    
} else {
    echo 0;
}


//get Favs as json or Comma seperated


?>