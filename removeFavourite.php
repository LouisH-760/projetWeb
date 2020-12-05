<?php
include 'favouriteFunctions.php';

if (isset($_GET['login']) && isset($_GET['id'])) {
    $login = $_GET['login'];
    $id = $_GET['id']; 

    $userFavsFileName = getUserFavsFileName($login);
    if (file_exists($userFavsFileName)) {
        $seperator = ";";
        $userFile = file_get_contents($userFavsFileName, true);
        $favs = explode($seperator, $userFile);

        foreach ($favs as $key => $value) {
              if (strcmp($value, $id) == 0) {
                unset($key);
            }
        }
        file_put_contents($userFavsFileName, implode($seperator, $favs)); 

        echo 1;

    } else {
        echo 0;
    }

} else {
    echo 0;
}
?>