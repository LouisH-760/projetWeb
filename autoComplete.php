<?php
    require_once("Donnees.inc.php");
    require_once("bob.php");
    require_once("searchAndAutoCompleteHelper.php");
    
    $exclude = testGetWithHierarchy($_GET["exclude"], $Hierarchie);

    
?>