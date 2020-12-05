<?php
require_once 'userDataFunctions.php';
if (isset($_GET['login'])) {
    $login = $_GET['login'];
    $userFavsFileName = getUserDataFileName($login);
    $userFile = file_get_contents($userFavsFileName, true);
    echo $userFile;


} else {
    echo 0;
}
?>




