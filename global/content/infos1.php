<?php

session_start();
echo "OK";

$data_legume = $_POST['legume'];

$actionLegume = $_POST["actionLegume"];

switch($data_legume){
    case "legumes0":
        if($actionLegume == "checked"){
            $_SESSION["avocat"] = "avocat"; 
            var_dump($_SESSION);
        }
        else
        {
            unset($_SESSION["avocat"]);
            var_dump($_SESSION);
        }
        
    break;
    case "legumes1":
        if ($actionLegume == "checked")
        {
            $_SESSION["carotte"] = "carotte"; 
            var_dump($_SESSION);
        }
        else
        {
            unset($_SESSION["carotte"]);
            var_dump($_SESSION);
        }
    break;
    case "legumes2":
        if($actionLegume == "checked"){
            $_SESSION["patate_douce"] = "patate douce"; 
            var_dump($_SESSION);
        }
        else
        {
            unset($_SESSION["patate_douce"]);
            var_dump($_SESSION);
        }
    break;
    case "legumes3":
        if($actionLegume == "checked"){
            $_SESSION["haricots"] = "haricots";
            var_dump($_SESSION); 
        }
        else
        {
            unset($_SESSION["haricots"]);
            var_dump($_SESSION);
        }
    break;
}
?>