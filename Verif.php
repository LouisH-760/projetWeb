<!DOCTYPE html>
<html>

<head>
      <title>Vérification</title>
      <meta charset="utf-8" />
      
</head>
<body>
<?php
print_r($_POST);


if (isset($_POST['login'])) {
    $login = trim($_POST['login']);
}

if (isset($_POST['passe'])) {
    $passe = strtolower(trim($_POST['passe']));
    $hashed_password = password_hash($passe, PASSWORD_DEFAULT);
}


//after login
$_SESSION["loggedInUser"] = $login;

//after registration
//create Favorites List
if (!isset($_SESSION['favs'])) {
    $favs = array(
        array(
            $login
        )
    );
    $_SESSION['favs'] = $favs;
    
} else {
    $favs = $_SESSION["favs"];
    $favs[] = array(
        $login
    );
    $_SESSION['favs'] = $favs;
    
}

//create Users List
if (!isset($_SESSION['users'])) {
    $users = array(
        array(
            $login, $hashed_password
        )
    );
    $_SESSION['users'] = $users;
    
} else {
    $users = $_SESSION["users"];
    $users[] = array(
        $login, $hashed_password
    );
    $_SESSION['users'] = $users;
    
}


$userFileName = $login . ".txt";
if (file_exists($userFileName)) {
    $userFile = file_get_contents($userFileName, true);
}else{
    $userFile = fopen($userFileName, "w");
    file_put_contents($userFileName, $hashed_password);
}


addIDtoUserFile($login, 3);
addIDtoUserFile($login, 4);
addIDtoUserFile($login, 5);
removeIDfromFavs($login, 3);
//print(existIdInFavs($login, 4));
$favs = getFavsFromUser($login);
print_r($favs);



//header("index.php");

function addIDtoFavs_old($login, $id) {
    $favs = $_SESSION["favs"];

    for ($i = 0; $i < sizeof($favs, 0); $i++) {
        if (strcmp($favs[$i][0], $login) == 0) {
            $favs[$i][] = $id;
        }
    }
    
    $_SESSION['favs'] = $favs;   
}

function removeIDfromFavs_old($login, $id) {
    $favs = $_SESSION["favs"];
    
    for ($i = 0; $i < sizeof($favs, 0); $i++) {
        if (strcmp($favs[$i][0], $login) == 0) {
            for ($j = 1; $j < sizeof($favs[$i], 0); $j++) {
                if (strcmp($favs[$i][$j], $id) == 0) {
                    unset($favs[$i][$j]);
                }
            }
        }
    }
    
    $_SESSION['favs'] = $favs; 
}
function getFavsFromUser_old($login){
    $favs = $_SESSION["favs"];
    
    for ($i = 0; $i < sizeof($favs, 0); $i++) {
        if (strcmp($favs[$i][0], $login) == 0) {
                unset($favs[$i][0]);
               return $favs[$i];
           
        }
    }
}
//----------------------------------------
function getUserFileName($login){
    $userFileName = $login . ".txt";
    if (file_exists($userFileName)) {
        $userFile = file_get_contents($userFileName, true);
        return $userFileName;
    }else{
        return false;
    }
}

function addIDtoUserFile($login, $id) {
    if (!existIdInFavs($login, $id)) {
        $seperator = ";";
        $userFileName = getUserFileName($login);
        $userFile = file_get_contents($userFileName);
        file_put_contents($userFileName, $userFile . $seperator.$id);  
    }
}

function existIdInFavs($login, $id){
    $favs = getFavsFromUser($login);
    return in_array($id, $favs);
}

function removeIDfromFavs($login, $id) {
    $favs = getFavsFromUser($login);

    for ($i = 1; $i < sizeof($favs, 0); $i++) {
        if (strcmp($favs[$i], $id) == 0) {
            unset($favs[$i]);
        }
    } 
}

function getFavsFromUser($login){
    $seperator = ";";
    $userFileName = getUserFileName($login);

    $favs = explode($seperator, file_get_contents($userFileName, true));
    unset($favs[0]);
    array_splice($favs);// <---------------
    return $favs;
}

function loginCorrect($login, $password){
    $seperator = ";";
    $userFileName = getUserFileName($login);
    $content = explode($seperator, file_get_contents($userFileName, true));
    $hashedPassword = $content[0];
    if (strcmp($hashed_password, password_hash($password, PASSWORD_DEFAULT)) == 0) {
        return true;
    }
    return false;

}

?>
<br>
Login : <?php

echo $login;

?>
<br>
  Mot de passe : <?php

echo $passe;

?>
<a href="Login.php" class="connection"> Retour au login </a>
</body>
</html>