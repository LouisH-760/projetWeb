<?php
require_once 'userDataFunctions.php';
if (isset($_GET['login'])) {
    $login = $_GET['login'];
} elseif(isset($_POST['login'])) {
    $login = $_POST['login'];
}
if (isset($_GET['passe'])) {
    $password = $_GET['passe'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
} elseif (isset($_POST['passe'])) {
    $password = $_POST['passe'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
}
if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
}else{
    $mail = "";
}
if (isset($_POST['nom'])) {
    $nom = $_POST['nom'];
}else{
    $nom = "";
}
if (isset($_POST['prenom'])) {
    $prenom = $_POST['prenom'];
}else{
    $prenom = "";
}
if (isset($_POST['sexe'])) {
    $sexe = $_POST['sexe'];
}else{
    $sexe = "";
}
if (isset($_POST['naissance'])) {
    $naissance = $_POST['naissance'];
}else{
    $naissance = "";
}
if (isset($_POST['adresse'])) {
    $adresse = $_POST['adresse'];
}else{
    $adresse = "";
}
if (isset($_POST['adresseCP'])) {
    $adresseCP = $_POST['adresseCP'];
}else{
    $adresseCP = "";
}
if (isset($_POST['adresseV'])) {
    $adresseV = $_POST['adresseV'];
}else{
    $adresseV = "";
}
    
$userFavsFileName = getUserDataFileName($login);
$userFile = fopen($userFavsFileName, "w");//overwriting file
    

file_put_contents($userFavsFileName, json_encode(compact(array("login", "hashedPassword", "mail", "nom", "prenom", "sexe", "naissance", "adresse", "adresseCP", "adresseV"))));

header("Location: index.php");


?>