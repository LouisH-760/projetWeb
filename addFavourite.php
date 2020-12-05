<?php
require_once 'favouriteFunctions.php';
if (isset($_GET['login']) && isset($_GET['id'])) {
    $login = $_GET['login'];
    $id = $_GET['id']; 
    
    $userFavsFileName = getUserFavsFileName($login);
    $userFile = "";
    if (file_exists($userFavsFileName)) {
        $userFile = file_get_contents($userFavsFileName, true);
    }else{
        fopen($userFavsFileName, "w");
    }
    $seperator = ";";
    file_put_contents($userFavsFileName, $userFile . $seperator . $id);

    echo 1;

} else {
    echo 0;
}
?>