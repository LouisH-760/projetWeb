<?php


function getUserDataFileName($login){
    return $login . "_userData" . ".txt";
}


function loginCorrect($login, $password){
    $userData = json_decode(getUserData($login), true);
    $hashedPassword = $userData["hashedPassword"];
    return password_verify($password, $hashedPassword);

}


function getUserData($login){
    
        $userFavsFileName = getUserDataFileName($login);
        $userFile = file_get_contents($userFavsFileName, true);
        return $userFile;
    
}
?>