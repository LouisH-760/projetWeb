<?php
include 'favouriteFunctions.php';
if (isset($_GET['login']) && isset($_GET['id'])) {
    $login = $_GET['login'];
    $id = $_GET['id']; 
    
    $userFavsFileName = getUserFavsFileName($login);
    if (file_exists($userFavsFileName)) {
        $userFile = file_get_contents($userFavsFileName, true);
    }else{
        $userFile = fopen($userFavsFileName, "w");
    }

    file_put_contents($userFavsFileName, $userFile . $seperator.$id);

        echo 1;

    } else {
        echo 0;
    }

} else {
    echo 0;
}


//get Favs as json or Comma seperated



   
//file_put_contents($userFileName, $hashed_password);


?>