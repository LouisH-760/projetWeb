<?php


function getUserFavsFileName($login){
    return $login . "_favourites" . ".txt";
}


function existIdInFavs($login, $id){
    $favs = getFavsFromUser($login);
    return in_array($id, $favs);
}


?>