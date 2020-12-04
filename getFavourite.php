<?php
include 'favouriteFunctions.php';
if (isset($_GET['login'])) {
    $login = $_GET['login'];
    
  

    $seperator = ";";
    $userFileName = getUserFileName($login);

    //$favs = explode($seperator, file_get_contents($userFileName, true));
    //unset($favs[0]);

    echo json_encode(array_values(explode($seperator, file_get_contents($userFileName, true))));
    
} else {
    echo 0;
}


//get Favs as json or Comma seperated





?>




