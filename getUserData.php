<?php
include 'favouriteFunctions.php';
if (isset($_GET['login'])) {
    $login = $_GET['login'];
    $userFavsFileName = getUserDataFileName($login);
    $userFile = file_get_contents($userFavsFileName, true);
    echo json_decode($userFile);


} else {
    echo 0;
}
?>




