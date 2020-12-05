<?php
    require_once("Donnees.inc.php");
    $id = (isset($_GET["id"])) ? $_GET["id"] : NULL;
    $result = ($id != NULL) ? $Recettes[$id]['titre'] : "erreur";
    echo $result;
?>