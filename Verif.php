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





function addIDtoFavs($login, $id) {
    
    $favs = $_SESSION["favs"];
    
    for ($i = 0; $i < sizeof($favs, 0); $i++) {
        if (strcmp($favs[$i][0], $login) == 0) {
            $favs[$i][] = $id;
        }
    }
    
    $_SESSION['favs'] = $favs;
    
    
}

function removeIDfromFavs($login, $id) {
    
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

function getFavsFromUser($login){

    $favs = $_SESSION["favs"];
    
    for ($i = 0; $i < sizeof($favs, 0); $i++) {
        if (strcmp($favs[$i][0], $login) == 0) {
                unset($favs[$i][0]);
               return $favs[$i];
           
        }
    }
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