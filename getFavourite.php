<?php
include 'favouriteFunctions.php';
if (isset($_GET['login'])) {
    $login = $_GET['login'];
    
    $seperator = ";";
    $userFileName = getUserFavsFileName($login);

    echo json_encode(array_values(explode($seperator, file_get_contents($userFileName, true))), true);
    
} else {
    echo 0;
}
?>




