<?php
    require_once("Donnees.inc.php");
    require_once("bob.php");
    require_once("searchAndAutoCompleteHelper.php");
    
    $exclude = false;
    if (isset($_GET["exclude"])) {
        $exclude = $_GET["exclude"];
        $exclude = completeWithUnder($exclude, $Hierarchie);
    }


?>