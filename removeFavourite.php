<?php
require_once 'favouriteFunctions.php';

if (isset($_GET['login']) && isset($_GET['id'])) {
    $login = $_GET['login'];
    $id = $_GET['id']; 

    $userFavsFileName = getUserFavsFileName($login);
    if (file_exists($userFavsFileName)) {
        $seperator = ";";
        $userFile = file_get_contents($userFavsFileName, true);
        $favs = explode($seperator, $userFile);
        $tmp = array();
        foreach ($favs as $key => $value) {
              if (strcmp($value, $id) != 0) {
                //unset($key);
                $tmp[] = $value;
            }
        }
        file_put_contents($userFavsFileName, implode($seperator, $tmp)); 

        header("Location: fav.php");

    } else {
        echo "erreur lors de la suppresion. <a href='index.php'>Retour à l'accueil</a>";
    }

} else {
    echo "erreur lors de la suppresion. <a href='index.php'>Retour à l'accueil</a>";
}
?>

