<?php


function getUserDataFileName($login){
    return $login . "_userData" . ".txt";
}


function loginCorrect($login, $password){
    $userData = json_decode(getUserData($login), true);
    $hashedPassword = $userData["hashedPassword"];
    if (strcmp($hashedPassword, password_hash($password, PASSWORD_DEFAULT)) == 0) {
        return true;
    }
    return false;

}


function getUserData($login){
    
        $userFavsFileName = getUserDataFileName($login);
        $userFile = file_get_contents($userFavsFileName, true);
        return $userFile;
    
}
?>